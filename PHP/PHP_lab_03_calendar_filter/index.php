<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>php_lab01_calendar</title>
    
    <link rel="stylesheet" href="css/style.css">
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/app.js"></script>
</head>

<body>
    <div id="dayCalendar">
       
        <!-- Список дат: -->
        <aside class="sidebar">
            <p>Выберите другую дату:</p>
            
            <?php
            
            //задаем переменные: текущий месяц, и текущий год
                //проверяем переменная со значением месяца была установлена в URL-адресе?
                //в ином случае, используем функцию date(), чтобы установить текущий месяц.
                if(isset($_GET['month'])) 
                    $month = $_GET['month'];
                elseif(isset($_GET['viewmonth'])) 
                    $month = $_GET['viewmonth'];
                else 
                    $month = date('m');//текуший месяц

                //проверяем переменная со значением года была установлена в URL-адресе?
                //в ином случае, используем функцию date(), чтобы установить текущий год.
                if(isset($_GET['year'])) 
                    $year = $_GET['year'];
                elseif(isset($_GET['viewyear'])) 
                    $year = $_GET['viewyear'];
                else 
                    $year = date('Y');//текущий год
            
            
            //Переключение на другой месяц/год.
           
                //$self = $_SERVER['PHP_SELF'];  // местоположение скрипта
            
                $months = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');

                echo "<form action='index.php' method='get' class='choose_date'><select name='month'>";

                for($i=0; $i<=11; $i++) {
                    echo "<option value='".($i+1)."'";
                    if($month == $i+1) 
                        echo "selected = 'selected'";
                    echo ">".$months[$i]."</option>";
                }

                echo "</select>";
                echo "<select name='year'>";

                for($i="1970"; $i<=(date('Y')+20); $i++){
                    
                    $selected = ($year == $i ? "selected = 'selected'" : '');

                    echo "<option value=\"".($i)."\"$selected>".$i."</option>";
                }

                echo "</select><input type='submit' value='смотреть' /></form>";    

            
            //Выводим список дат:
            
                $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);//количество дней в месяце

                for($i=1;$i<=$num;$i++){
                    $mktime=mktime(0,0,0,$month,$i,$year);
                    $date=date('d.m.Y',$mktime);
                    echo '<a href="choosendate.php?dt='.$date.'">'.$date.'</a><br>';
                };
                

            ?>
            
        </aside>
        
        <div class="content">
           
            <h1>Календарь событий</h1>
            
            <div class="date">
                <span class="heads">Сегодня:</span>
                <h2 id="logDate"><!--Здесь выводим..Дату--></h2>
            </div>
            
            <div class="header">
                <span class="heads">Событие:</span>
                <h2 id="logHeader"><!--Здесь выводим..Заголовок события--></h2>
            </div>
            
            <div id="logImg"><!--Здесь выводим..Картинку--></div>

            <div class="desc">
                <p id="logDesc"><!--Здесь выводим..Описание события --></p>
            </div>
        </div>
    </div>
 
</body>

</html>