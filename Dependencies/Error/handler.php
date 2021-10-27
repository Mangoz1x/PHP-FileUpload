<?php
    if (isset($_GET['nofile'])) {
        ?>
            <div class="dark-bg-custom z-index-error" id="errorHandler">
                <div class="errorHandler">
                    <div class="centerContent">
                        <h2 class="custom-text-align-center-error">Oops, looks like you haven't selected any files!</h2>
                        <div onclick="cancleErrorHandler()">Dismiss</div>
                    </div>
                </div>
            </div>
        <?php 
    } else if (isset($_GET['err'])) {
        ?>
            <div class="dark-bg-custom z-index-error" id="errorHandler">
                <div class="errorHandler">
                    <div class="centerContent">
                        <h2 class="custom-text-align-center-error">Oops, an unexpected error has occurred!</h2>
                        <div onclick="cancleErrorHandler()">Dismiss</div>
                    </div>
                </div>
            </div>
        <?php 
    } else if (isset($_GET['nosupport'])) {
        ?>
            <div class="dark-bg-custom z-index-error" id="errorHandler">
                <div class="errorHandler">
                    <div class="centerContent">
                        <h2 class="custom-text-align-center-error">Oops, looks like we dont support that file type!</h2>
                        <div onclick="cancleErrorHandler()">Dismiss</div>
                    </div>
                </div>
            </div>
        <?php 
    } else if (isset($_GET['tolarge'])) {
        ?>
            <div class="dark-bg-custom z-index-error" id="errorHandler">
                <div class="errorHandler">
                    <div class="centerContent">
                        <h2 class="custom-text-align-center-error">Oops, looks like the file(s) is to large!</h2>
                        <div onclick="cancleErrorHandler()">Dismiss</div>
                    </div>
                </div>
            </div>
        <?php 
    } else if (isset($_GET['nouser'])) {
        ?>
            <div class="dark-bg-custom z-index-error" id="errorHandler">
                <div class="errorHandler">
                    <div class="centerContent">
                        <h2 class="custom-text-align-center-error">Oops, looks like you havnt selected a user!</h2>
                        <div onclick="cancleErrorHandler()">Dismiss</div>
                    </div>
                </div>
            </div>
        <?php 
    } else if (isset($_GET['dbnone'])) {
        ?>
            <div class="dark-bg-custom z-index-error" id="errorHandler">
                <div class="errorHandler">
                    <div class="centerContent">
                        <h2 class="custom-text-align-center-error">Oops, we couldnt find the user "<?php echo htmlentities($_GET['nfuser']); ?>"!</h2>
                        <div onclick="cancleErrorHandler()">Dismiss</div>
                    </div>
                </div>
            </div>
        <?php 
    } else if (isset($_GET['selfsend'])) {
        ?>
            <div class="dark-bg-custom z-index-error" id="errorHandler">
                <div class="errorHandler">
                    <div class="centerContent">
                        <h2 class="custom-text-align-center-error">You cannot send a file to yourself!</h2>
                        <div onclick="cancleErrorHandler()">Dismiss</div>
                    </div>
                </div>
            </div>
        <?php 
    } else if (isset($_GET['nfoldername'])) {
        ?>
            <div class="dark-bg-custom z-index-error" id="errorHandler">
                <div class="errorHandler">
                    <div class="centerContent">
                        <h2 class="custom-text-align-center-error">Oops, looks like you haven't entered a folder name!</h2>
                        <div onclick="cancleErrorHandler()">Dismiss</div>
                    </div>
                </div>
            </div>
        <?php 
    } else if (isset($_GET['doublef'])) {
        ?>
            <div class="dark-bg-custom z-index-error" id="errorHandler">
                <div class="errorHandler">
                    <div class="centerContent">
                        <h2 class="custom-text-align-center-error">Oops, looks like you already have a folder named "<?php echo htmlentities($_GET['fname']); ?>"!</h2>
                        <div onclick="cancleErrorHandler()">Dismiss</div>
                    </div>
                </div>
            </div>
        <?php 
    }
?>

<style>
    .errorHandler {
        width: 50%;
        height: 50%;
        background-color: whitesmoke;
        border-radius: 10px;
        color: black;
        animation: animateErrorHandler 0.4s;
    } 

    .z-index-error {
        z-index: 999999999 !important;
    }

    .dark-bg-custom {
        background-color: rgba(0,0,0, 0.7);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 99999;
        /*animation: animateErrorHandlerBg 0.4s; TO ANIMATE BACKGROUND*/
    }

    .centerContent {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .custom-text-align-center-error {
        text-align: center;
        max-width: 80%;
    }

    /* @keyframes animateErrorHandlerBg {
        0% {
            opacity: 0.0;
        }
        100% {
            opacity: 1;
        }
    } */

    @keyframes animateErrorHandler {
        0% {
            opacity: 0.0;
            transform: scale(0.6,0.6);
        }
        75% {
            opacity: 0.8;
            transform: scale(1.15,1.15);
        }
        100% {
            opacity: 1;
            transform: scale(1,1);
        }
    }

    @media only screen and (max-height: 850px) {
        .errorHandler {
            height: 65%;
        } 
    }

    @media only screen and (max-width: 1450px) {
        .errorHandler {
            width: 80%;
        } 
    }

    @media only screen and (max-width: 950px) {
        .errorHandler {
            width: 95%;
        } 
    }
</style>