<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Payment Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
            text-align: center;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #888;
        }

        .card-mask {
            letter-spacing: 2px;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 8px;
                padding: 10px;
            }

            td {
                text-align: left;
                padding-left: 50%;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                font-weight: bold;
                color: #333;
            }
        }
    </style>
</head>
<body>
    <div style="text-align: left; margin: 20px;">
    <a href="index.html" style="
        display: inline-block;
        padding: 10px 20px;
        background-color: #2c3e50;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 600;
    ">&larr; Back to Main Page</a>
    </div>

    <h2>Payment Records</h2>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Card</th>
                    <th>Expiry</th>
                    <th>CVV</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database credentials
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "sneakerstore";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("<tr><td colspan='7'>Connection failed: " . $conn->connect_error . "</td></tr>");
                }

                // Fetch payment data
                $sql = "SELECT name, phone, address, card_number, expiry_month, expiry_year, cvv FROM payments";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    $serialNumber = 1;
                    while ($row = $result->fetch_assoc()) {
                        // Mask card number and CVV
                        $maskedCard = str_repeat("•", 12) . substr($row['card_number'], -4);
                        $maskedCVV = str_repeat("•", strlen($row['cvv']));
                        echo "<tr>
                                <td data-label='No.'>$serialNumber</td>
                                <td data-label='Name'>{$row['name']}</td>
                                <td data-label='Phone'>{$row['phone']}</td>
                                <td data-label='Address'>{$row['address']}</td>
                                <td data-label='Card'><span class='card-mask'>{$maskedCard}</span></td>
                                <td data-label='Expiry'>{$row['expiry_month']}/{$row['expiry_year']}</td>
                                <td data-label='CVV'>{$maskedCVV}</td>
                              </tr>";
                        $serialNumber++;
                    }
                } else {
                    echo "<tr><td colspan='7' class='no-data'>No payment records found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>