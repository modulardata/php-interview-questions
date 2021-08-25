  dat = new Date();
  month = dat.getMonth();
  monthname = new Array();
  monthname[0] = "JANUARY";
  monthname[1] = "FEBRUARY";
  monthname[2] = "MARCH";
  monthname[3] = "APRIL";
  monthname[4] = "MAY";
  monthname[5] = "JUNE";
  monthname[6] = "JULY";
  monthname[7] = "AUGUST";
  monthname[8] = "SEPTEMBER";
  monthname[9] = "OCTOBER";
  monthname[10] = "NOVEMBER";
  monthname[11] = "DECEMBER";
  day = dat.getDate();
  if (day == 1) {dayadd = "ST";}
  else if (day == 21) {dayadd = "ST";}
  else if (day == 31) {dayadd = "ST";}
  else if (day == 2) {dayadd = "ND";}
  else if (day == 22) {dayadd = "ND";}
  else if (day == 3) {dayadd = "RD";}
  else if (day == 23) {dayadd = "RD";}
  else {dayadd = "TH";}
  year = dat.getFullYear();
  //time =dat.getTime();
  //hour = dat.getHours();
  //minute= dat.getMinutes();
  //second= dat.getSeconds();
  document.write('<span class="topNavGray">' + monthname[month] + ' ' + day + '<sup><span style="font-size:6px">' + dayadd + '</span></sup>, ' + year + '</span>');