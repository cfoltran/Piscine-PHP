#!/usr/bin/php
<?php
	echo "Computer donain host : ";
	$computer = system('nslookup $(ipconfig getifaddr en0) | grep name | cut -d " " -f3 | cut -d "." -f1');
	$whoami = system('whoami');

	echo "\033[35m-------------------------------------------ex02------------------------------------\033[0m\n";
	echo "test 1 : ";
	$req = shell_exec("curl 'http://" . $computer . ".42.fr:8100/ex02/print_get.php?login=mmontinet'");
	if ($req == "login: mmontinet\n") {
		echo "\033[32m[OK]\033[0m\n";
	} else {
		echo "\033[31m[FAUX]\033[0m\n";
	}

	echo "test 2 : ";
	$req = shell_exec("curl 'http://" . $computer . ".42.fr:8100/ex02/print_get.php?gdb=pied2biche&barry=barreamine'");
	if ($req == "gdb: pied2biche\nbarry: barreamine\n") {
		echo "\033[32m[OK]\033[0m\n";
	} else {
		echo "\033[31m[FAUX]\033[0m\n";
	}

	echo "\033[35m-------------------------------------------ex03------------------------------------\033[0m\n";
	echo "test 1 : ";
	$req = shell_exec("curl -c cook.txt 'http://" . $computer . ".42.fr:8100/ex03/cookie_crisp.php?action=set&name=plat&value=choucroute'");
	if ($req == "") {
		echo "\033[32mCreate cookie [OK]\033[0m\n";
	} else {
		echo "\033[31m[FAUX]\033[0m\n";
	}

	echo "test 2 : ";
	$req = shell_exec("curl -b cook.txt 'http://" . $computer . ".42.fr:8100/ex03/cookie_crisp.php?action=get&name=plat'");
	if ($req == "choucroute\n") {
		echo "\033[32mDisplay cookie [OK]\033[0m\n";
	} else {
		echo "\033[31m[FAUX]\033[0m\n";
	}

	echo "test 3 : ";
	$req = shell_exec("curl -c cook.txt 'http://" . $computer . ".42.fr:8100/ex03/cookie_crisp.php?action=del&name=plat'");
	if ($req == "") {
		echo "\033[32mDestroy cookie [OK]\033[0m\n";
	} else {
		echo "\033[31m[FAUX]\033[0m\n";
	}

	echo "\033[35m-------------------------------------------ex04------------------------------------\033[0m\n";
	echo "test 1 : ";
	$req = shell_exec("curl -c cook.txt 'http://" . $computer . ".42.fr:8100/ex04/raw_text.php'");
	if ($req == "<html><body>Hello</body></html>\n") {
		echo "\033[32mCURL [OK]\033[0m\n";
	} else {
		echo "\033[31m[FAUX]\033[0m\n";
	}

	echo "\ntest 2 : \n";
	$req = shell_exec("lynx -source 'http://" . $computer . ".42.fr:8100/ex04/raw_text.php'");
	if ($req == "<html><body>Hello</body></html>\n") {
		echo "\n\033[32mLYNX -source [OK]\033[0m\n";
	} else {
		echo "\033[31m[FAUX]\033[0m\n";
	}

	echo "\ntest 3 : \n";
	$req = shell_exec("lynx -dump 'http://" . $computer . ".42.fr:8100/ex04/raw_text.php'");
	if ($req == "<html><body>Hello</body></html>\n\n") {
		echo "\n\033[32mLYNX -source [OK]\033[0m\n";
	} else {
		echo "\033[31m[FAUX]\033[0m\n";
	}

echo "\033[35m-------------------------------------------ex05------------------------------------\033[0m\n";
echo "test 1 : ";
$req = shell_exec("curl --head 'http://" . $computer . ".42.fr:8100/ex05/read_img.php' | cat -e");
$rep = "HTTP/1.1 200 OK^M\$\nHost: e1r9p10.42.fr:8100^M\$\nConnection: close^M\$\nX-Powered-By: PHP/5.6.30^M\$\nContent-type:image/png^M\$\n^M\$\n";
if ($req == $rep) {
	echo "\033[32mREAD IMG [OK]\033[0m\n";
} else {
	echo "\033[31m[FAUX]\033[0m\n";
}

echo "\033[35m-------------------------------------------ex06------------------------------------\033[0m\n";
echo "test 1 : ";
$req = shell_exec("curl --user zaz:jaimelespetitsponeys http://e1r9p10.42.fr:8100/ex06/members_only.php | head -n 2");
if ($req == "<html><body>\nBonjour Zaz<br />\n") {
	echo "\033[32mLINE 1->2 [OK]\033[0m\n";
} else {
	echo "\033[31m[FAUX]\033[0m\n";
}

echo "test 2 : ";
$req = shell_exec("curl --user zaz:jaimelespetitsponeys http://e1r9p10.42.fr:8100/ex06/members_only.php | tail -n 1");
if ($req == "</body></html>\n") {
	echo "\033[32mLAST LINE OK [OK]\033[0m\n";
} else {
	echo "\033[31m[FAUX]\033[0m\n";
}
?>