

/*
Реализуйте функцию getCustomDate(), которая принимает дату в формате timestamp и возвращает ее в формате 15/03/1985:

<?php

getCustomDate(1532435204); // 24/07/2018
getCustomDate(532435204);  // 15/11/1986
getCustomDate(5324352);    // 03/03/1970

*/



<?php

function getCustomDate($timestamp){
    return date("d/m/Y", $timestamp);
}