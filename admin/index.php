<?php require_once "../database/posts_functions.php" ?>    
<?php require_once "../database/comments_functions.php" ?>
<?php require_once "../database/users_functions.php" ?>        
<?php require_once "../database/category_functions.php" ?>    

<?php require "includes/admin_header.php" ?>

<div id="wrapper">

<?php require "includes/admin_navigation.php" ?>

    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Widgets -->    
            <div class="row">
                <h1 class="page-header text-center">Dashboard</h1>
               
                <?php
                /* POSTS */
                $widget_label = "Posts";                
                $widget_link = "posts.php";

                $posts = getAllPosts();
                $count_label = count($posts);

                require "includes/dashboard_widget.php";
                    
                /* COMMENTS */
                $widget_label = "Comments";                
                $widget_link = "comments.php";

                $comments = getAllComments();
                $count_label = count($comments);

                require "includes/dashboard_widget.php";
                    
                /* USERS */
                $widget_label = "Users";                
                $widget_link = "users.php";

                $users = getAllUsers();
                $count_label = count($users);

                require "includes/dashboard_widget.php";

                /* CATEGORIES */
                $widget_label = "Categories";                
                $widget_link = "categories.php";

                $categories = getAllCategories();
                $count_label = count($categories);

                require "includes/dashboard_widget.php";
                ?>
            </div>
            
            <!-- Chart -->
            <div class="container row col-xs-12">
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = new google.visualization.arrayToDataTable([
                            ['Metric', 'Count'],
                            <?php
                            $metrics = ['Published posts', 'Draft posts',
                                        'Approved comments', 'Unapproved comments',
                                        'Admin users', 'Other users',
                                        'Categories'];
                            $counts = [count(getPublishedPosts()), count(getDraftPosts()),
                                       count(getApprovedComments()), count(getUnapprovedComments()),
                                       count(getAdminUsers()), count(getNoAdminUsers()),
                                       count(getAllCategories())];
                            
                            for ($i = 0; $i < 7; $i++) {
                                echo "['$metrics[$i]', $counts[$i]],";  
                            }
                            ?>
                        ]);

                        var options = {
                            title: '',
                            width: '100%',
                            height: '100%',
                            legend: { position: 'none' },
                            chart: { subtitle: '' },
                            axes: {
                                x: {
                                    0: { side: 'top', label: '' } // Top x-axis.
                                }
                            },
                            bar: { groupWidth: '75%' }
                        };

                        var chart = new google.charts.Bar(document.getElementById('chart'));
                        // Convert the Classic options to Material options.
                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                    
                    // Make the chart responsive
                    if (document.addEventListener) {
                        window.addEventListener('resize', drawChart);
                    }
                    else if (document.attachEvent) {
                        window.attachEvent('onresize', drawChart);
                    }
                    else {
                        window.resize = resizeChart;
                    }
                </script>
                
                <div id="chart" style="width: 100%; height: 500px;"></div>
                
            </div>  

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<?php require "includes/admin_footer.php" ?>