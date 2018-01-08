<?php

if(isset($_POST['submit'])){
$ip = $_POST['range'];
$labname = $_POST['labname'];
 $myfile = fopen($labname.".py", "w");
 $i = 0;
$txt = "from __future__ import print_function\nimport multiprocessing\nimport subprocess\nimport os\nfrom time import gmtime, strftime\nfrom datetime import datetime\nimport MySQLdb as my\ndef pinger( job_q, results_q ):\n\tDEVNULL = open(os.devnull,'w')\n\twhile True:\n\t\tip = job_q.get()\n\t\tif ip is None: break\n\t\ttry:\n\t\t\tsubprocess.check_call(['ping','-c1',ip],stdout=DEVNULL)\n\t\t\tresults_q.put(ip)\n\t\texcept:\n\t\t\tpass\nif __name__ == '__main__':\n\tpool_size = 255\n\tjobs = multiprocessing.Queue()\n\tresults = multiprocessing.Queue()\n\tpool = [ multiprocessing.Process(target=pinger, args=(jobs,results)) for i in range(pool_size) ]\n\tfor p in pool:\n\t\tp.start()\n\tfor i in range(1,255):\n\t\tjobs.put('".$ip.".{0}'.format(i))\n\tfor p in pool:\n\t\tjobs.put(None)\n\tfor p in pool:\n\t\tp.join()\n\toutput = ''\n\ta = str(datetime.now());\n\toutput += a[:19]\n\toutput +=' '\n\twhile not results.empty():\n\t\tip = results.get()\n\t\tip += ' '\n\t\toutput +=ip\n\tprint(output)\ndb = my.connect(host=\"localhost\"\n\t\t\t\tuser=\"root\",\n\t\t\t\tpasswd=\"mysqleptp\",\n\t\t\t\tdb=\"KLUIOT\"\n\t\t\t\t)\n\tcursor = db.cursor()\n\tid = \"".$labname."\"\n\tnumber_of_rows = cursor.execute('''insert into iptable (labno,online) VALUES(%s,%s)''',(id,output))\n\tdb.commit()\n\tdb.close()";
fwrite($myfile, $txt);
fclose($myfile);


$myfile = fopen("sol1.py", "a");
 $i = 0;
$txt = "\n\tos.system('python /var/www/html/Ippython/".$labname.".py')";
fwrite($myfile, $txt);
fclose($myfile);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="test.php" method = "POST">
    NAME:-<input type="text" name="labname">[No-Spaces]<br>
    RANGE:-<input type="text" name="range">[EX:-10.45.31]<br>
    <input type="submit" name = "submit">
    </form>
</body>
</html>