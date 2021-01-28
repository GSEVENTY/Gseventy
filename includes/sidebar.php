<?php require_once("config.php"); ?>

<div class="sidebar">
    <div class="sidebar-icons">
        <?php
        //  Take all categories to show in sidebar.
        $sql = "SELECT * FROM categories";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $cats = $stmt->fetchAll();

        foreach ($cats as $cat) {
            $cat_id = $cat->cat_id;
            $cat_title = $cat->cat_title;
            $cat_image = $cat->cat_image;

        ?>

            <a href="./category.php?category=<?php echo $cat_id ?>" class="sidebar-icon">
                <img src="./assets/images/sidebar-icon/<?php echo $cat_image ?>" alt="sidebar-icons" />
                <span class="sidebar-span"><?php echo $cat_title ?></span>
            </a>
        <?php } ?>
    </div>

    <div class="sidebar-footer">
        <a href="#" class="s-a">Contact us</a></br>
        <a href="#" class="s-a">Write for us</a><br>
        <p class="s-a">&copy;2020 GSEVENTY</p>
        <button class="sidebar-btn open" onclick="openSidebar()"><img id="list-icon" src="./assets/images/list1.png" alt="icon" style="width: 30px; height: 30px; color: white" /></button>
        <button class="sidebar-btn close" onclick="closeSidebar()"><img id="list-icon" src="./assets/images/list2.png" alt="icon" style="width: 30px; height: 30px; color: white" /></button>
    </div>
</div>