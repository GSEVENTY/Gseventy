<?php require_once("includes/classes/DateModifier.php"); ?>

<!-- HEADER  -->
<?php include "./includes/header.php" ?>

<!-- NAVIGATION -->
<?php include "./includes/navigation.php" ?>

<?php
// if user not logged in then page should redirect to index.php.
if (!isset($_SESSION['logged_in'])) {
    header("Location: ./index.php");
    exit();
}

// Using session to take username then taking user data from db by using username.
$user_id = $_SESSION['user_id'];
$sql = 'SELECT * FROM users WHERE user_id=:ui';
$stmt = $connection->prepare($sql);
$stmt->execute(['ui' => $user_id]);
$users = $stmt->fetchAll();

foreach ($users as $user) {
    $name = $user->user_firstname;
    $username = $user->username;
    $user_bio = $user->biography;
?>
    <!-- User profile starts from here. -->
    <div class="profile">
        <div class="profile-card">
            <div class="profile-card-content">
                <div class="profile-card-img">
                    <img src="./assets/images/dummy-profile.jpg" alt="profile-img">
                </div>
                <div class="profile-card-body">
                    <div>
                        <span class="profile-name"><?php echo $name ?></span>
                        <a href="./update-profile.php">Edit Profile</a>
                    </div>
                    <span class="profile-username">@<?php echo $username ?></span>
                    <span class="profile-bio-head">Achievements in Gaming</span>
                    <span class="profile-bio"><?php echo $user_bio; ?></span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<div class="cards">
    <div class="card">
        <div class="card-writer">
            <span><a href="/profile.html">Bucky</a></span>
            <div>
                <a href="#">Delete</a>
                <span>3 days ago</span>
            </div>
        </div>
        <div class="card-content">
            <div class="card-img">
                <img src="https://media.comicbook.com/2020/05/gta-5-grand-theft-auto-1220406.jpeg?auto=webp&width=1200&height=628&crop=1200:628,smart" alt="">
                <span>Image Credit: NDTV</span>
            </div>
            <div class="card-body">
                <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, vel.</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil aliquam libero veritatis
                    corporis
                    soluta reprehenderit modi magni eveniet cumque, saepe eius incidunt deserunt veniam
                    doloribus
                    est error, eum fuga? Impedit, sunt nesciunt! Nisi, accusantium adipisci! Doloremque, aliquam
                    aliquid iusto minus recusandae iste, cum magni hic quaerat, libero voluptatem! Reiciendis,
                    consequuntur?</p>
            </div>
        </div>
        <div class="card-footer">
            <div class="card-vote">
                <!-- <i class="far fa-thumbs-up"></i>
                    <span>20</span> -->
                <span>Hardware</span>
            </div>
            <div class="card-ext-link">
                <a href="#">Edit</a>
                <a target="_blank" href="#"><i class="external-link fa fa-external-link"></i></a>
            </div>
        </div>
    </div>
</div>


<?php include "./includes/footer.php" ?>