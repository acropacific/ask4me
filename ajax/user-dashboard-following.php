<?php
session_start();
require_once dirname(dirname(__FILE__)).'/displayErrors.php';
require_once dirname(dirname(__FILE__))."/vendor/autoload.php";

$user = unserialize(base64_decode($_SESSION['user']));

$FF = new \classes\User\FollowingFactory($user->getId());

$translate = new \classes\Languages\Translate($_COOKIE['lang'])
?>

<div class="section followers animated fadeIn">
    <h4 class="dashboard-heading"><?php echo $translate->getString("profilesUreFollow") ?></h4>
    <div class="part escort">
        
        <div class="wrapper">
            <?php if(empty($FF->getUsers())):?>
                <p><?php echo $translate->getString("UDFollowAnyone") ?></p>
            <?php endif?>

            <?php foreach($FF->getUsers() as $following){ ?>
            <div class="profile">
                <div class="box">
                    <div class="icons">
                        <a h-ref="#" class="med-prim-bg white-txt message" login="<?php echo $following->getLogin() ?>"><i class='material-icons'>mail_outline</i></a>
                        <a h-ref="#" onclick="follow(<?php echo $following->getId() ?>)" class="med-prim-bg white-txt"><i class='follow material-icons unfollow'></i></a>
                        <a href="#" data-toggle="modal" data-target="#gift" class="med-prim-bg white-txt"><i class="fa fa-gift"></i></a>
                        <a href="#" data-toggle="modal" data-target="#request" class="med-prim-bg white-txt"><i class="fa fa-user-circle"></i></a>
                        <a href="#" data-toggle="modal" data-target="#block" class="med-prim-bg white-txt"><i class='material-icons'>block</i></a>
                    </div>
                    <a href="model.php">
                        <div class="photo" style="background:url(<?php echo $following->getProfilePicture()->getSRCThumbImage() ?>) no-repeat center center"></div>
                        <div class="med-prim-bg white-txt text">
                            <span><?php echo $following->getLogin() ?>,</span>
                            <span class="lt-txt"><?php echo $following->getCountry()->getName() ?></span>
                        </div>
                    </a>
                </div>
            </div>
            <?php }?>
            
            
        </div>
    </div>
    
</div>

<script src="/js/follow.js"></script>
<script>
//follow unfollow
$('.follow').on('click', function() {
    $(this).toggleClass("unfollow");
});
</script>