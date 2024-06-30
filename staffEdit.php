<?php
include("classes/autoloadclass.php");

$staffEdit = new StaffFunction();
$login = new StaffFunction();
$user_data = $login->check_login($_SESSION['ekomuniti_staffID']);
$USER = $user_data;

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $profile = new Profile();
    $profile_data = $profile->get_profile($_GET['id']);
    if(is_array($profile_data)) {
        $user_data = $profile_data[0];
    }
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $staffEdit->delete_user($_POST['userID']);
    }
}

// Get search query or fetch all users if no query is provided
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$users = !empty($search_query) ? $staffEdit->search_users($search_query) : $staffEdit->get_all_users();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Komuniti | Edit Staff</title>
    <style>
        body {
            font-family: 'Candara';
            background: url('ekomunitiEdit.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #333;
        }
        #top-bar {
            height: 80px;
            background-color: #ffde59; 
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        #top-bar h1 {
            margin: 0;
            font-size: 24px;
        }
        .button {
            background-color: #45a049;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            margin: 0 10px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }
        .button:hover {
            background-color: #3e8e41;
        }
        #logout {
            background-color: #ff4b4b;
        }
        #logout:hover {
            background-color: #d43f3f;
        }
        .container {
            margin: 40px auto;
            width: 90%;
            max-width: 1200px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .search-bar {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-bar input[type="text"] {
            padding: 8px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .search-bar button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #45a049;
            color: white;
        }
        .search-bar button:hover {
            background-color: #3e8e41;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #004aad;
            color: white;
        }
        .expandable {
            display: none;
        }
        .expandable td {
            padding: 20px;
        }
        .action-buttons button {
            padding: 8px 16px;
            margin-right: 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .action-buttons .arrow {
            background-color: #4CAF50;
            color: white;
        }
        .action-buttons .arrow:hover {
            background-color: #45a049;
        }
        .action-buttons .delete {
            background-color: #f44336;
            color: white;
        }
        .action-buttons .delete:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
<div id="top-bar">
    <h1><a href="staff_homepage.php">Admin e-Komuniti</a></h1>
    <div>
        <a href="staffEdit.php" class="button">Mengurus Pengguna</a>
        <a href="manageposting.php" class="button">Mengurus Posting</a>
        <a href="stafflogout.php" id="logout" class="button">Log Out</a>
    </div>
</div>
<div class="container">
    <div class="search-bar">
        <form method="get" action="">
            <input type="text" name="search" placeholder="Search by Name, House Number, Nickname, or Email" value="<?= htmlspecialchars($search_query) ?>">
            <button type="submit">Search</button>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>House Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (is_array($users) && count($users) > 0): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['houseNum']) ?></td>
                    <td class="action-buttons">
                        <button class="arrow" data-user-id="<?= $user['userID'] ?>">&#x25BC;</button>
                        <form method="post" style="display:inline;" onsubmit="return confirmDelete();">
                            <input type="hidden" name="userID" value="<?= $user['userID'] ?>">
                            <button type="submit" name="delete" class="delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <tr class="expandable" id="expand-<?= $user['userID'] ?>">
                    <td colspan="4">
                        <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
                        <p><strong>Nickname:</strong> <?= htmlspecialchars($user['nickname']) ?></p>
                        <p><strong>Gender:</strong> <?= htmlspecialchars($user['gender']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                        <p><strong>House Number:</strong> <?= htmlspecialchars($user['houseNum']) ?></p>
                        <!-- Password is usually not displayed for security reasons -->
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No users found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var arrowButtons = document.querySelectorAll('.arrow');
        arrowButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var userId = button.getAttribute('data-user-id');
                var expandableRow = document.getElementById('expand-' + userId);
                expandableRow.style.display = expandableRow.style.display === 'none' || expandableRow.style.display === '' ? 'table-row' : 'none';
            });
        });
    });

    function confirmDelete() {
        return confirm("Are you sure you want to delete this user?");
    }
</script>
</body>
</html>
