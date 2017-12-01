<?php
    
    require_once "../lib/bootstrap.php";
    User::require_login();
    require_once "html/partials/header.php";
    
    // Get the page ID.
    if(isset($_GET['page'])){
        $the_page_id = $_GET['page'];
    }
    
    // Get the return url
    if(isset($_GET['return'])){
        $return = $_GET['return'];
    }
    else{
        $return = 'index.php';
    }
    
    // Get the src for the iframe
    if(empty($the_page_id)){
        // The page is the homepage
        $src = Settings::get('url');
        $page_title = 'Homepage';
    }
    else{
        // Get the page url
        $page = new Page($the_page_id);
        if($page->exists){
            $src = Settings::get('url') . $page->uri;
            $page_title = $page->title;
        }
        else{
            die('<h1 class="text-center">404! Page does not exist.</h1>');   
        }
    }
    
    // Create the go back section.
    $render = "
        <div class='container-fluid'>
            <div class='page-header'>
                <div class='row'>
                    <div class='col-md-6'>
                          <h4 class='pull-left'><b>Page Preview</b> $page_title</h2>
                    </div>
                    <div class='col-md-6'>
                        <h4 class='pull-right'> 
                            <a href='$return'>
                                <i class='fa fa-arrow-left'></i>
                                Go Back
                            </a>
                        </h4>
                    </div>
                </div> 
            </div>
        </div>
    ";
    
    // Add the actual preview of the page
    $render .= "
        <div class='container-fluid'>
            <iframe src='$src' width='100%' height='100%'></iframe>
        </div>
    ";
    
    // Render the content
    print $render;
    
    