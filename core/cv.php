<?php

function CVcount($db) {
  $sql = "SELECT COUNT(*) AS `count` FROM `cv`;";
  $result = $db->query($sql);
  if ($result) {
    $result = $db->query($sql);
    if ($result) {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      $cv_count = $row["count"];
      $result->close();
    }
  } else {
    $cv_count = 0;
  }
  return($cv_count);
}

function getCVs($db) {
  $ret = array();
  $sql = "SELECT * FROM `cv`;";
  $result = $db->query($sql);
  if ($result) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $ret[] = $row;
    }
    $result->close();
  }
  return($ret);
}

function printCVs($CVs) {
  if (!userAllow("view-cv")) {return;}
  $out  = "<h2>".t("Controlled Vocabularies")."</h2>";
  $out .= "<table>";
  $out .= "<tr><th>".t("Short name")."</th><th>".t("Name")."</th></tr>";
  foreach ($CVs as $CV) {
    $out .= "<tr><td>".l($CV["shortname"], "/cv/".$CV["shortname"])."</td><td>".$CV["name"]."</td></tr>";
  }
  $out .= "</table>";
  print($out);
}
