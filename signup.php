<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do App - Signup</title>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f5f5f5;
        }

        .form{
            width: 380px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        h1{
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        table{
            width: 100%;
        }

        table td{
            padding: 8px 5px;
        }

        label{
            font-weight: bold;
            color: #444;
        }

        input{
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            outline: none;
            transition: .3s;
        }

        input:focus{
            border-color: limegreen;
            box-shadow: 0 0 5px rgba(50,205,50,0.4);
        }

        button{
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 10px;
            background: limegreen;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: .3s;
        }

        button:hover{
            background: green;
        }

        .login{
            display: block;
            text-align: center;
            margin-top: 18px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
        }

        .login:hover{
            color: limegreen;
        }
    </style>
</head>
<body>

<form action="/To-do/add.php" method="post" class="form">

    <h1>To-Do App</h1>

    <table>

        <tr>
            <td><label for="fullname">Full Name</label></td>
            <td>
                <input type="text" id="fullname" name="fullname" placeholder="Enter your full name"
                    required>
            </td>
        </tr>

        <tr>
            <td><label for="email">Email</label></td>
            <td>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </td>
        </tr>

        <tr>
            <td><label for="password">Password</label></td>
            <td>
                <input type="password" id="password" name="password" 
                placeholder="Enter your password" minlength="8" required>
            </td>
        </tr>

    </table>

    <button type="submit" name="signup">Signup</button>

    <a href="/To-Do/index.php" class="login">
        Already have an account? Login here
    </a>

</form>

</body>
</html>