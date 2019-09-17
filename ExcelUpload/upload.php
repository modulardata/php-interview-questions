<HTML>
<!-- upload.php -->
<?
// Copy the file to C:\upload.txt. Remember to escape backslashes!
if (copy($userfile, "C:\\upload.txt")) {
echo("<B>File successfully copied!</B>");
} else {
echo("<B>Error: failed to copy file...</B>");
}
// Destroy the file now we've copied it
unlink($userfile);
?>
</HTML>