<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Задача про таксопарк</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-md-4 col-sm-12" style="height: 100vh; padding: 200px 0px">
            <div style="max-width: 400px; width: 100%; margin: auto">
                <form action="Answer.php" method="post">
                    <fieldset>
                        <legend>Введите данные</legend>
                        <label for="days">Кол-во дней</label>
                        <input type="text" id="Days" name="days" placeholder="200" />
                        <label for="days">Имя файла для отчета</label>
                        <input type="text" id="File_name" name="file_name" placeholder="отчет" />
                        <input type="submit">
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>
</body>