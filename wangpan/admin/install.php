<?php
require_once('include/sqltool.php');

$cretab=new sqltool();
$sql = "CREATE TABLE ".$table_prefix."users (".
"u_id  bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,".
"u_name  varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"u_pass  varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"u_level  int(11) NOT NULL ,".
"u_registered  datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ,".
"PRIMARY KEY (u_id,u_name),".
"UNIQUE INDEX  u_name  ( u_name ) USING BTREE)".
"ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ROW_FORMAT=COMPACT";

$cretab->executedml($sql);
echo $cretab->selecttime."<br>";

$sql = "CREATE TABLE ".$table_prefix."department (".
"d_id  int(11) UNSIGNED NOT NULL ,".
"d_name   varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"PRIMARY KEY ( d_id ),".
"UNIQUE INDEX  d_name  ( d_name ) USING BTREE )".
"ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT";

$cretab->executedml($sql);
echo $cretab->selecttime."<br>";

$sql = "CREATE TABLE ".$table_prefix."class (".
"cl_id  bigint(20) UNSIGNED NOT NULL ,".
"cl_name  varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"cl_year  year NOT NULL DEFAULT 0000,".
"d_id  int(11) UNSIGNED NOT NULL ,".
"PRIMARY KEY (cl_id),".
"FOREIGN KEY (d_id) REFERENCES ".$table_prefix."department (d_id) ON DELETE CASCADE ON UPDATE NO ACTION,".
"INDEX cl_name (cl_name) USING BTREE ,".
"INDEX d_id (d_id) USING BTREE ,".
"INDEX cl_year (cl_year) USING BTREE )".
"ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT";

$cretab->executedml($sql);
echo $cretab->selecttime."<br>";

$sql = "CREATE TABLE ".$table_prefix."student (".
"s_no  bigint(20) UNSIGNED NOT NULL ,".
"s_name  varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"s_sex  char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"s_birthday  date NOT NULL DEFAULT '0000-00-00' ,".
"s_ps  char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"d_id  int(11) UNSIGNED NOT NULL ,".
"cl_id  bigint(20) UNSIGNED NOT NULL ,".
"s_address  varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"s_phone  varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"s_email  varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' ,".
"cl_year  year NOT NULL DEFAULT 0000 ,".
"PRIMARY KEY (s_no),".
"FOREIGN KEY (d_id) REFERENCES ".$table_prefix."department (d_id) ON DELETE CASCADE ON UPDATE NO ACTION,".
"FOREIGN KEY (cl_id) REFERENCES ".$table_prefix."class (cl_id) ON DELETE CASCADE ON UPDATE NO ACTION,".
"FOREIGN KEY (cl_year) REFERENCES ".$table_prefix."class (cl_year) ON DELETE RESTRICT ON UPDATE NO ACTION,".
"UNIQUE INDEX s_no (s_no) USING BTREE ,".
"FULLTEXT INDEX s_name (s_name) ,".
"UNIQUE INDEX s_phone (s_phone) USING BTREE ,".
"INDEX d_id (d_id) USING BTREE ,".
"INDEX cl_id (cl_id) USING BTREE ,".
"INDEX cl_year (cl_year) USING BTREE )".
"ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT";

$cretab->executedml($sql);
echo $cretab->selecttime."<br>";

$sql = "CREATE TABLE ".$table_prefix."teacher (".
"t_id  bigint(20) UNSIGNED NOT NULL ,".
"t_name  varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"t_sex  char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"t_birthday  date NOT NULL DEFAULT '0000-00-00' ,".
"t_ps  char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"d_id  int(11) UNSIGNED NOT NULL ,".
"t_address  varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"t_phone  varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"t_email  varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' ,".
"PRIMARY KEY (t_id),".
"FOREIGN KEY (d_id) REFERENCES ".$table_prefix."department (d_id) ON DELETE CASCADE ON UPDATE NO ACTION,".
"UNIQUE INDEX t_id (t_id) USING BTREE ,".
"FULLTEXT INDEX t_name (t_name) ,".
"UNIQUE INDEX t_phone (t_phone) USING BTREE ,".
"INDEX d_id (d_id) USING BTREE )".
"ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT";

$cretab->executedml($sql);
echo $cretab->selecttime."<br>";

$sql = "CREATE TABLE ".$table_prefix."course (".
"co_id  bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT ,".
"co_name  varchar(60)CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"t_id  bigint(20) UNSIGNED NOT NULL ,".
"co_credie  int(11) UNSIGNED NOT NULL ,".
"co_period  int(11) UNSIGNED NOT NULL ,".
"co_book  varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"co_class  varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"PRIMARY KEY (co_id),".
"FOREIGN KEY (t_id) REFERENCES ".$table_prefix."teacher (t_id) ON DELETE CASCADE ON UPDATE NO ACTION,".
"UNIQUE INDEX co_name (co_name) USING BTREE ,".
"FULLTEXT INDEX co_class (co_class) )".
"ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ROW_FORMAT=COMPACT";

$cretab->executedml($sql);
echo $cretab->selecttime."<br>";

$sql = "CREATE TABLE ".$table_prefix."score (".
"s_no  bigint(20) UNSIGNED NOT NULL ,".
"co_id  bigint(20) UNSIGNED NOT NULL ,".
"sc_score  int(11) UNSIGNED NOT NULL ,".
"sc_level  char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' ,".
"PRIMARY KEY (s_no, co_id),".
"FOREIGN KEY (s_no) REFERENCES ".$table_prefix."student (s_no) ON DELETE NO ACTION ON UPDATE NO ACTION ,".
"FOREIGN KEY (co_id) REFERENCES ".$table_prefix."course (co_id) ON DELETE NO ACTION ON UPDATE NO ACTION ,".
"INDEX s_no (s_no) USING BTREE ,".
"INDEX co_id (co_id) USING BTREE)".
"ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT";

$cretab->executedml($sql);
echo $cretab->selecttime."<br>";

$sql = "CREATE TABLE ".$table_prefix."meta (".
"meta_id  bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT ,".
"meta_key  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL  ,".
"meta_value  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL  ,".
"PRIMARY KEY (meta_id))".
"ENGINE = InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT = 1 ROW_FORMAT = COMPACT";

$cretab->executedml($sql);
echo $cretab->selecttime."<br>";


$cretab->close();

?>