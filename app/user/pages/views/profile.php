<?php
include "../../config/conn.php";

// Memastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Query untuk mengambil data user beserta jumlah favorit
$query = "SELECT u.user_username, u.user_email, u.user_image, u.user_telepon, COUNT(f.movie_id) AS num_favorites
          FROM user u
          LEFT JOIN favorites f ON u.user_id = f.user_id
          WHERE u.user_id = $userId
          GROUP BY u.user_username, u.user_email, u.user_image, u.user_telepon";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "User not found.";
    exit();
}
?>

<body class="dark:bg-black dark:text-white bg-gray-100">
    <section class="w-full overflow-hidden dark:bg-black">
        <div class="flex flex-col">
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1719427209368-8ee06271a8b1?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="User Profile" class="w-full xl:h-[20rem] lg:h-[18rem] md:h-[16rem] sm:h-[14rem] xs:h-[11rem]" />
            </div>

            <div class="sm:w-[80%] xs:w-[90%] mx-auto flex justify-center ">
                <div class="relative">
                    <div class="absolute z-10 mt-14 bottom- right-2 rounded-full p-2 cursor-pointer" onclick="handleEdit()">
                        <i class="fas fa-edit text-white outline-1 outline-gray-400 text-2xl"></i>
                    </div>
                    <img src="<?= $user['user_image'] ?>" class="relative rounded-md lg:w-[12rem] lg:h-[15rem] md:w-[10rem] md:h-[10rem] sm:w-[8rem] sm:h-[8rem] xs:w-[7rem] xs:h-[7rem] outline outline-2 outline-offset-2 outline-white lg:bottom-[5rem] sm:bottom-[4rem] xs:bottom-[3rem]" />
                </div>
            </div>

            <div class="xl:w-[80%] lg:w-[90%] md:w-[90%] sm:w-[92%] xs:w-[90%] mx-auto flex flex-col gap-4 items-center relative lg:-top-8 md:-top-6 sm:-top-4 xs:-top-4">
                <div class="w-full my-auto py-6 flex flex-col justify-center gap-2">
                    <div class="w-full flex sm:flex-row xs:flex-col gap-2 justify-center">
                        <div class="w-1/2 outline outline-offset-2 outline-1 p-6 rounded-lg">
                            <table class="w-full text-gray-900">
                                <tbody>
                                    <tr class="pb-3">
                                        <td class="mb-1 text-gray-400 md:text-lg">Username</td>
                                        <td class="text-lg text-gray-200 font-semibold">:</td>
                                        <td class="text-lg text-gray-200 font-semibold"><?= $user['user_username'] ?></td>
                                    </tr>
                                    <tr class="pb-3">
                                        <td class="mb-1 text-gray-400 md:text-lg">Email</td>
                                        <td class="text-lg text-gray-200 font-semibold">:</td>
                                        <td class="text-lg text-gray-200 font-semibold"><?= $user['user_email'] ?></td>
                                    </tr>
                                    <tr class="pb-3">
                                        <td class="mb-1 text-gray-400 md:text-lg">Telephone</td>
                                        <td class="text-lg text-gray-200 font-semibold">:</td>
                                        <td class="text-lg text-gray-200 font-semibold"><?= $user['user_telepon'] ?></td>
                                    </tr>
                                    <tr class="pb-3">
                                        <td class="mb-1 text-gray-400 md:text-lg">Favorites</td>
                                        <td class="text-lg text-gray-200 font-semibold">:</td>
                                        <td class="text-lg text-gray-200 font-semibold"><?= $user['num_favorites'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" onclick="handleEdit()" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Edit -->
    <div id="editModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-edit text-green-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit User Information</h3>
                            <div class="mt-2">
                                <form id="editForm">
                                    <div>
                                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                        <input type="text" name="username" id="username" value="<?= $user['user_username'] ?>" class="mt-1 p-2 text-black border border-gray-300 rounded-md w-full" required>
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" id="email" value="<?= $user['user_email'] ?>" class="mt-1 p-2 text-black border border-gray-300 rounded-md w-full" required>
                                    </div>
                                    <div>
                                        <label for="telephone" class="block text-sm font-medium text-gray-700">Telephone</label>
                                        <input type="text" name="telephone" id="telephone" value="<?= $user['user_telepon'] ?>" class="mt-1 p-2 text-black border border-gray-300 rounded-md w-full" required>
                                    </div>
                                    <div class="mt-4">
                                        <button type="button" onclick="submitEditForm()" class="inline-flex justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700">Save</button>
                                        <button type="button" onclick="closeModal()" class="inline-flex justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700">Cancel</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function handleEdit() {
            document.getElementById("editModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("editModal").classList.add("hidden");
        }

        function submitEditForm() {
            const form = document.getElementById('editForm');
            const formData = new FormData(form);

            fetch('pages/controller/profile/update_user.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log('Server response:', data); // Tambahkan ini untuk debugging
                    if (data.includes('success')) { // Memastikan ada 'success' di dalam respons
                        Swal.fire('Profile updated successfully', '', 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', 'Failed to update profile: ' + data, 'error'); // Tampilkan error yang lebih informatif
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Failed to update profile', 'error');
                });
        }
    </script>
</body>

<?php
// Menutup koneksi
mysqli_close($conn);
?>