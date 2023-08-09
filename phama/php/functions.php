
<?php
function ordinalSuffix($num) {
    if ($num % 100 >= 11 && $num % 100 <= 13) {
        return $num . 'th';
    } else {
        switch ($num % 10) {
            case 1:
                return $num . 'st';
            case 2:
                return $num . 'nd';
            case 3:
                return $num . 'rd';
            default:
                return $num . 'th';
        }
    }
    
}
function formatDate($theDate)
{
$dateString =  $theDate;
$date = new DateTime($dateString);
$day = $date->format("d");
$formattedDay = ordinalSuffix($day);
$formattedDate = $date->format("D, d M, Y");
echo $formattedDate;
}

?>