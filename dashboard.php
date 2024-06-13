<?php
session_start();
require 'connection.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$id = $_SESSION['user_id'];

// Fetch user details
$query = "SELECT * FROM personal_table WHERE user_id='$id'";
$con = $connection->query($query);
$user = $con->fetch_assoc();
if (!$user) {
    die('User not found.');
}
$firstname = $user['firstname'];
$lastname = $user['lastname'];

// Handle contact form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phonenumber'];
    $email = $_POST['email'];

    if (isset($_POST['contact_table']) && $_POST['contact_action'] == 'add_contact') {
        $query = "INSERT INTO contacts_table (user_id, firstname, lastname, phonenumber,email) VALUES (?, ?, ?, ?)";
        $insert_stmt = $connection->prepare($query);
        if ($insert_stmt === false) {
            echo ('Prepare failed: ' . ($connection->error));
        }
        $insert_stmt->bind_param('isss', $id, $firstname, $lastname, $phone, $email);
        if (!$insert_stmt->execute()) {
            echo ('Execute failed: ' . ($insert_stmt->error));
        }
    } elseif (isset($_POST['contact_table']) && $_POST['contact_action'] == 'update_contact' && isset($_POST['contact_id'])) {
        $contact_id = $_POST['contact_id'];
        $update_query = "UPDATE contact_table SET firstname = ?,lastname = ?, phone = ?,email = ? WHERE contact_id = ? AND user_id = ?";
        $update_stmt = $connection->prepare($update_query);
        if ($update_stmt === false) {
            echo ('Prepare failed: ' . ($connection->error));
        }
        $update_stmt->bind_param('sssii', $firstname, $lastname, $phone, $email, $contact_id, $id);
        if (!$update_stmt->execute()) {
            echo ('Execute failed: ' . ($update_stmt->error));
        }
    }
}

// Fetch contacts
$contacts_query = "SELECT * FROM contact_table WHERE user_id = '$id'";
$contacts_result = $connection->query($contacts_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
        }
    </style>
    <script>
        function populateUpdateForm(contactId, contactName, contactEmail, contactPhone) {
            document.getElementById('contact_id').value = contactId;
            document.getElementById('contact_name').value = contactName;
            document.getElementById('contact_email').value = contactEmail;
            document.getElementById('contact_phone').value = contactPhone;
            document.getElementById('contact_action').value = 'update_contact';
            document.getElementById('submit_button').innerText = 'Update Contact';
        }
    </script>
</head>

<body>
    <div class="col-6 mx-auto shadow p-1">
        <div class="col-8">
            <div class="shadow p-3">
                <p>Welcome to your Dashboard <span class="text-primary"><?php echo $firstname . ' ' . $lastname; ?></span></p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2>Update Contact</h2>
                <form method="POST">
                    <div class="form-group">
                        <input type="hidden" name="contact_id" id="contact_id">
                        <input type="text" name="firstname" id="contact_name" placeholder="firstname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="contact_id" id="contact_id">
                        <input type="text" name="lastname" id="contact_name" placeholder="lastname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" id="phonenumber" placeholder="Phone number" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="contact_action" value="add_contact" id="submit_button" class="btn btn-primary">Add Contact</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2>Your Contacts</h2>
                <ul>
                    <li>
                        <button onclick="populateUpdateForm(
                                <?php echo $contact['contact_id']; ?>, 
                                '<?php echo (addslashes($contact['firstname'])); ?>', 
                                '<?php echo (addslashes($contact['lstname'])); ?>', 
                                '<?php echo (addslashes($contact['email'])); ?>', 
                                '<?php echo (addslashes($contact['phone'])); ?>')">Update</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>