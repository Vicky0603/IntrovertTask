<?PHP
    require_once 'lib.php';
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Table of Success Leads</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        
        <form action="<?=$_SERVER['REQUEST_URI']?>">
            <input type="date" name='start' value="2018-01-01" required>
            <input type="date" name='end' value="2018-01-01" required>
            <input type='submit'>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                $start = strtotime($_GET['start']);
                $end = strtotime($_GET['end']);
            }
        ?>
        
            <?php
                if (!$start and !$end){
                    echo '<p>Укажите даты начала и конца</p>';
                }
                if ($start and $end){
                    $totalSum = 0;
                    echo '<table>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Сумма успешных сделок за данный период</th>
                            </tr>';
                    $clients = getClients();
                    foreach ($clients as $key => $value) {
                        $sum = sumOfSuccessLeads($value['api'],$start,$end);
                        if ($sum !== false){
                            $totalSum += $sum;
                            echo 
                               '<tr>
                                <td>'.$value["id"].'</td>
                                <td>'.$value["name"].'</td>
                                <td>'.$sum.'</td>
                                </tr>';
                        }
                        
                    }
                    echo '</table>';
                    echo '<p>Сумма по всем клиентам за период: '.$totalSum.'</p>';

                }
            ?>
    </body>
</html>