<?php
    //the conction with the data base
        $con =mysqli_connect("localhost","root","","mydatabase");
        if(!$con){
        die("Connection failed: " . mysqli_connect_error());
        }
    //This line checks if the request method is POST. It ensures that the following code block is lanched 
    //only when a form is submitted using the POST method.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if it's a delete request
    if (isset($_POST['deleteId'])) {
        $deleteId = $_POST["deleteId"];
        $deleteQuery = "DELETE FROM member WHERE id = '$deleteId'";
        //This line lanch the delete query using the mysqli_query function and stores the result in the $result variable
        $result = mysqli_query($con, $deleteQuery);

        if ($result) {
            header("Location: member.php"); 
        } else {
            echo "Error deleting user: " . mysqli_error($con);
        }
    } else { // It's an add request
        $phoneNumber = $_POST["phoneNumber"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $role = $_POST["role"];
        $status = $_POST["status"];
        $team = $_POST["team"];

        $insertQuery = "INSERT INTO member (telephone, nom, prenom, email, role, statut, equipe) 
                        VALUES ('$phoneNumber', '$firstName', '$lastName', '$email', '$role', '$status', '$team')";
        mysqli_query($con, $insertQuery);

        header("Location: member.php");
    }
}

    // Fetch data by performing an INNER JOIN between the 'member' and 'equipe' tables
    // based on the condition that the 'equipe' column in the 'member' table matches the 'id_equipe' column in the 'equipe' table.
    $query = "SELECT * FROM member INNER JOIN equipe ON member.equipe = equipe.id_equipe";

    // Execute the SQL query and store the result in the $result variable.
    // This result can be used to fetch and process the data retrieved from the database.
    $result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>table</title>
</head>
<body>
    <div class="bg-gray-100 py-10">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Members</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the members in our company including their fullName, title, phoneNumber, email, status, its team, and role.</p>
                </div>
            </div>
            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle">
                        <div class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">id</th>
                                        <th scope="col" class="mdpx-3 py-3.5 text-center text-sm font-semibold text-gray-900">phoneNumber</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">firstName</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">lastName</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">email</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">role</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">status</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">team</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">created at</th>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $row['id'] ?></td>
                                            <td class="text-center"><?php echo $row['telephone'] ?></td>
                                            <td class="text-center"><?php echo $row['prenom'] ?></td>
                                            <td class="text-center"><?php echo $row['nom'] ?></td>
                                            <td class="text-center"><?php echo $row['email'] ?></td>
                                            <td class="text-center"><?php echo $row['role'] ?></td>
                                            <td class="text-center"><?php echo $row['statut'] ?></td>
                                            <td class="text-center"><?php echo $row['nom_de_equipe'] ?></td>
                                            <td class="text-center"><?php echo $row['date_de_creation'] ?></td>
                                            <td class="text-center">
                                                <form method="post" action="">
                                                    <input type="hidden" name="deleteId" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-center p-16">
                <form class="w-full max-w-lg" method="post" action="">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                Your phone number
                            </label>
                            <input name="phoneNumber" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="5454544315" required>
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                First Name
                            </label>
                            <input name="firstName" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Doe" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                Last Name
                            </label>
                            <input name="lastName" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Jane" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                                Email
                            </label>
                            <input name="email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="email" placeholder="bruh@gmail.com" required>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                Role
                            </label>
                            <div class="relative">
                                <select name="role" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option>developer</option>
                                    <option>director</option>
                                    <option>designer</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                Status
                            </label>
                            <div class="relative">
                                <select name="status" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option>Unactif</option>
                                    <option>active</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                                Team
                            </label>
                            <div class="relative">
                                <select name="team" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none ml-96">
                        <button type="submit" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add user</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
