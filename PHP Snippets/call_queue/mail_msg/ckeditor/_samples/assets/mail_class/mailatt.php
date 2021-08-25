<?php
 ###################################################################################
 ##                                                                               ##
 ##  Function mime_mailer: Sends plain mail, html mail, html mail with embeded    ##
 ##  images and it is possible to send attachments with all of the former.        ##
 ##                                                                               ##
 ##  mime_mailer(string to,                                                       ##
 ##              string subject,                                                  ##
 ##              string message [,                                                ##
 ##              string additional_headers [,                                     ##
 ##              array attachments [,                                             ##
 ##              string $css]]])                                                  ##
 ##                                                                               ##
 ##  $to $subject and $headers all work identically to PHP's mail function but    ##
 ##  there is no need to add MIME headers.                                        ##
 ##                                                                               ##
 ##  $message can be plain text or can contain html tags. Text outside <body>     ##
 ##  will be ignored. <img> tags 'src' must either be a local path, relative to   ##
 ##  document root or an absolute http path. These images will then be embeded in ##
 ##  the mail automatically.                                                      ##
 ##                                                                               ##
 ##  $attachments is an array. It contains the filenames and paths (relative to   ##
 ##  document root) of any files that are to be included with the mail. Example:  ##
 ##  $attachments = array('image.jpg', 'directory/file.ext', '../docs/file.doc'); ##
 ##                                                                               ##
 ##  $css appears between <style> tags inside the head of the mail. Example:      ##
 ##  $css = 'body{ color: #f00; background: #bbb; }';                             ##
 ##                                                                               ##
 ##  Style info may also be embeded into the html tags of the message body.       ##
 ##                                                                               ##
 ##  Place this file in the root directory and call it as per this example:       ##
 ##                                                                               ##
 ##  require_once($_SERVER['DOCUMENT_ROOT'].'/mime_mailer.php');                  ##
 ##  mime_mailer($to, $subject, $message);                                        ##
 ##                                                                               ##
 ###################################################################################

if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])) send_404(); // stop http access to this file

function mime_mailer($to, $subject, $message, $headers = NULL, $attachments = NULL, $css = NULL)
{
    if(!preg_match('/^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,6})$/', $to)) return FALSE;
    if(preg_match('/<(html|head|body|div|a|h|p|table|br|img|b|hr|ol|ul|span|pre|i|form)[^>]*[^>]*>/i', $message)) $html = TRUE;
    if(stristr($message, '<body')) $message = stristr($message, '<body');
    $message = delete_local_links($message);
    if(empty($headers)){
       $headers = "MIME-Version: 1.0\n";
    }else{
       $headers.= "\nMIME-Version: 1.0\n";
    }
    if(empty($html)){
       $result = plain_text($message);
    }elseif(isset($html) and $html == TRUE){
       if(!isset($css)) $css = NULL;
       if(preg_match('/<img[^>]+>/i', $message)){
           $result = multipart_related($message, $css);
       }else{
           $result = multipart_alternative($message, $css);
       }
   }
   $result['message'] = delete_non_cid_images($result['message']);
   if(!empty($attachments)){
       $parts = attachments($attachments);
       array_unshift($parts, implode('', $result));
       $result = multipart_mixed($parts);
   }
   $headers = $headers.$result['headers'];
   //print '<pre>'.htmlspecialchars($headers.$result['message']).'</pre>';exit;
   if(mail($to, $subject, $result['message'], $headers)) return TRUE;
   return FALSE;
}

function plain_text($message, $html = NULL)
{
   if(!empty($html)){
       $message = str_replace("\n", '', str_replace("\r\n", '', $message));
       $search = array('/(<p[^>]*>)/i', '/(<br[^>]*>)/i');
       $replace = array("\n\n", "\n");
       $message = preg_replace($search, $replace, $message);
   }
   $headers = "Content-Type: text/plain; charset=ISO-8859-1; format=flowed\n".
              "Content-Transfer-Encoding: 7bit\n\n";
      $message =  convert_links(preg_replace('/<img[^>]*alt=[\'"]([^\'"]+)[\'"][^>]*>/i', '[$1]', $message))."\n\n";
   return (array('headers' => $headers, 'message' => $message));
}


function multipart_alternative($message, $css = NULL)
{
   if(empty($css)) $css = NULL; else $css = "<style type=\"text/css\">\n<!--\n".$css."\n-->\n</style>\n";
   if(!preg_match('#[<]+body#i', $message)) $message = "<body>\n".$message."\n";
   if(!preg_match('#[<]+/body[>]+#i', $message)) $message = $message."\n</body>\n";
      $boundary = "mime_boundry_multipart/alternative_".md5(time())."x";
   $headers = "Content-Type: multipart/alternative; boundary=\"{$boundary}\"\n\n";
   $message = "--{$boundary}\n".
              implode('', plain_text($message, TRUE)).                                  "--{$boundary}\n".
              "Content-Type: text/html; charset=ISO-8859-1\n".
              "Content-Transfer-Encoding: 7bit\n\n".
              "<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n".
              "<html>\n".
              "<head>\n".
              "<meta content=\"text/html;charset=ISO-8859-1\" http-equiv=\"Content-Type\">\n".
              "<title></title>\n".
              $css.
              "</head>\n".
              $message."\n".
              "</html>\n\n".
              "--{$boundary}--\n\n";
   return (array('headers' => $headers, 'message' => $message));
}

function multipart_related($message, $css = NULL)
{
   if(empty($css)) $css = NULL;
   $cid = md5(time()); $i = 0;
   $boundary = "mime_boundry_multipart/related_".md5(time())."x";
   $headers = "Content-Type: multipart/related; boundary=\"{$boundary}\"\n\n";
  preg_match_all('/<img[^>]+?src=[\'"]+(http:\/\/[^\'"]*)[\'"][^>]*>/i', $message, $matches);
   $increment = 0;
   if(!empty($matches)){
       foreach($matches['1'] as $match){
           $images[$increment] = http_retrieve($match);
           $images[$increment]['body'] = chunk_split(base64_encode($images[$increment]['body']));
           $images[$increment]['tag'] = $matches['0'][$increment];
           $images[$increment]['uri'] = $matches['1'][$increment];
           $increment++;
       }
   }
   $message = "--{$boundary}\n".
              implode('', multipart_alternative($message, $css));
              if(!empty($images)){
                  foreach($images as $image){
                      if(!empty($image['headers'])
                      and
                      isset($image['headers']['HTTP'])
                      and
                      preg_match('/200/', $image['headers']['HTTP'])
                      and
                      isset($image['headers']['Content-Type'])
                      and
                      preg_match('/image\//', $image['headers']['Content-Type'])){
                          $message .= "--{$boundary}\n".
                                  'Content-Type: '.$image['headers']['Content-Type'].'; name="'.basename($image['uri']).'"'."\n".
                                  'Content-Transfer-Encoding: base64'."\n".
                                  'Content-ID: '.$cid.$i."\n\n".
                                  $image['body']."\n";
                          $search = '#(<img[^>]+?src=[\'"]+)'.$image['uri'].'([\'"][^>]+>)#i';
                          $replace = '$1cid:'.$cid.$i.'$2';
                          $message = preg_replace($search, $replace, $message);
                          $i++;
                                                }else{
                          $search = '#(<img[^>]+?src=[\'"]+)'.$image['uri'].'([\'"][^>]+>)#i';
                          $message = preg_replace($search, '[image: '.$image['uri'].' not available]', $message);
                      }
                   }
               }
               unset($images);
              preg_match_all('/<img[^>]+?src=[\'"](?!cid:)([^\'"]*)[\'"][^>]*>/i', $message, $matches);
               foreach($matches['1'] as $match){
                   if(is_readable($_SERVER['DOCUMENT_ROOT'].'/'.$match)){
                       $images[$increment]['details'] = getimagesize($_SERVER['DOCUMENT_ROOT'].'/'.$match);
                       $images[$increment]['string'] = chunk_split(base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/'.$match)));
                       $images[$increment]['file'] = $matches['1'][$increment];
                       $images[$increment]['tag'] = $matches['0'][$increment];
                       $increment++;
                   }
               }
               if(!empty($images)){
                   foreach($images as $image){
                       $message .= "--{$boundary}\n".
                                      'Content-Type: '.$details['mime'].'; name="'.basename($image['file']).'"'."\n".
                                      'Content-Transfer-Encoding: base64'."\n".
                                      'Content-ID: '.$cid.$i."\n\n".
                                       $image['string']."\n";
                              $search = '#(<img[^>]+?src=[\'"]+)'.$image['file'].'([\'"][^>]*>)#i';
                              $replace = '$1cid:'.$cid.$i.'$2';
                              $message = preg_replace($search, $replace, $message);
                              $i++;
                   }
               }
         $message .= "--{$boundary}--\n\n";
   return (array('headers' => $headers, 'message' => $message));
}

function multipart_mixed($parts)
{
   $boundary = "mime_boundry_multipart/mixed_".md5(time())."x";
   $headers = "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\n\n";
   $message = '';
   foreach($parts as $part){
       $message .= "--{$boundary}\n".$part."\n";
   }
   $message .= "--{$boundary}--\n\n";
   return (array('headers' => $headers, 'message' => $message));
}

function convert_links($text)
{
 # define regexp components for main regexp:
 $start  = '<a\s[^>]*href=';               # start of A link
 $mail_q = '[\'"]mailto:([^\'"]+)[\'"]';   # quoted mailto
 $mail_u = 'mailto:([^\s>]+)';             # unquoted mailto
 $link_q = '[\'"](h?[ft]tp:[^\'"]+)[\'"]'; # quoted http or ftp link
 $link_u = '(h?[ft]tp:[^\s>]+)';           # unquoted http or ftp link
 $end    = '[^>]*>(.+)<\/a>';              # end of A link

 $search = array("/$start(?:$mail_q|$mail_u|$link_q|$link_u)$end/i",
                 '/<a\s[^>]*>(.*)<\/a>/i');  # local file or other non-match
 $replace = array('\5 (\1\2\3\4)', '\1');
 return(strip_tags(preg_replace($search, $replace, $text)));
}

function delete_local_links($text)
# Strip out local links and leave the only http links
{
$search = array('/<a[^>]+?href=(?!"http|"ftp|"mailto|\'http|\'ftp|\'mailto|http|ftp|mailto)[^>]*>(.+?)<\/a>/i');
$replace = array('\1');
return(preg_replace($search, $replace, $text));
}

function delete_non_cid_images($text)
# Strip out local links and leave the only http and cid links
{
$search = array('/<img[^>]+?src=[\'"](?!cid)[^\'"]+[\'"]+.+?alt=[\'"]([^\'"]+)[\'"]+[^>]*>/i',
                '/<img[^>]+?alt=[\'"]([^\'"]+)[\'"]+.+?src=[\'"](?!cid)[^\'"]+[\'"]+[^>]*>/i',
                '/<img[^>]+?src=(?!\'cid|"cid)[^>]*>/i');
$replace = array('[unavailable image: $1]', '[unavailable image: $1]', '[unavailable image]');
return(preg_replace($search, $replace, $text));
}

function attachments($attachments)
{
   if (!function_exists('mime_content_type')){
       function mime_content_type($file){
           if(!is_readable($file)) return false;
           @$size = getimagesize($file);
           if(!empty($size[mime])){
               return($size[mime]);
           }else{
               $extensions = array('doc' => 'application/msword', 'html'=> 'text/html', 'htm' => 'text/html',
                   'pdf' => 'application/pdf', 'ppt' => 'application/vnd.ms-powerpoint', 'rtf' => 'text/rtf',
                   'xls' => 'application/vnd.ms-excel', 'zip' => 'application/zip');
               $keys = array_keys($extensions);
               $parts = array_reverse(explode('.', $file));
               $extension = $parts['0'];
               if(in_array($extension, $keys)) return $extensions[$extension];
               $data = file_get_contents($filename);
               $bad = false;
               for($x = 0, $y = strlen($data); !$bad && $x < $y; $x++){
                   $bad = (ord($data{$x}) > 127);
               }
               if(!$bad) return ('text/plain');
               return('application/octet-stream');
           }
       }
   }
   $parts = array();
   foreach($attachments as $key => $value){
   $value = $_SERVER['DOCUMENT_ROOT'].'/'.$value;
   $mime_type = mime_content_type($value);
   if(is_file($value) and is_readable($value)){
       $filesize = filesize($value);
       $file = fopen($value,'rb');
       $data = fread($file,$filesize);
       fclose($file);
       $data = chunk_split(base64_encode($data));
       $value = pathinfo($value);
       $parts[] =  "Content-Type: $mime_type;\n" .
                   " name=\"{$value[basename]}\"\n" .
                   "Content-Transfer-Encoding: base64\n" .
                   "Content-Disposition: attachment;\n" .
                   " filename=\"{$value[basename]}\"\n\n" .
                   $data . "\n\n";
       }
   }
   return($parts);
}

function http_retrieve($url, $followRedirects = true)
{
  # Returns array(['url'] array(['headers']) ['body']) on success
  # Returns array(['url'] ['errornumber'] ['errorstring']) on failure
  $url = preg_replace('/[\r]|[\n]/', '', $url);       $url_parsed = parse_url($url);
  if (empty($url_parsed['scheme'])) $url_parsed = parse_url('http://'.$url);
  $return['url'] = $url_parsed;
  if(!isset($url_parsed["port"])) $url_parsed["port"] = 80;
  $return['url']['port'] = $url_parsed["port"];
  $path = $url_parsed["path"];
  if(empty($path)) $path="/";
  if(!empty($url_parsed["query"])) $path .= "?".$url_parsed["query"];
  $return['url']['path'] = $path;
  $host = $url_parsed["host"];
  $foundBody = false;
  $out = "GET $path HTTP/1.0\r\n";
  $out .= "Host: $host\r\n";
  $out .= "Connection: Close\r\n\r\n";
  if(!$fp = @fsockopen($host, $url_parsed["port"], $errornumber, $errorstring, 5)){
      $return['errornumber'] = $errornumber;
      $return['errorstring'] = $errorstring;
      return $return;
  }
  fwrite($fp, $out);
  $headers = NULL;
  $body = NULL;
  while (!feof($fp)) {
      $s = fgets($fp, 128);
      if ($s == "\r\n"){
          $foundBody = true;
          continue;
      }
      if ($foundBody){
          $body .= $s;
      }else{
          if(($followRedirects) && (stristr($s, "location:") != false))
                  return http_retrieve(trim(preg_replace("/location:/i", "", $s)));
          $headers .= $s;
      }
  }
  fclose($fp);
  $headers = explode("\n", trim($headers));
  foreach($headers as $header){
      if(strpos($header, ':')){
          list($header, $value) = explode(':', $header);
          $return['headers'][trim($header)] = trim($value);
      }else{
          $return['headers'][substr($header, 0, 4)] = $header;
      }
  }
  $return['body'] = trim($body);
  return $return;
}

function send_404()
{
   header('HTTP/1.x 404 Not Found');
   print '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">'."\n".
   '<html><head>'."\n".
   '<title>404 Not Found</title>'."\n".
   '</head><body>'."\n".
   '<h1>Not Found</h1>'."\n".
   '<p>The requested URL '.
   str_replace(strstr($_SERVER['REQUEST_URI'], '?'), '', $_SERVER['REQUEST_URI']).
   ' was not found on this server.</p>'."\n".
   '</body></html>'."\n";
   exit;
}
?> 