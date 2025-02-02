<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

<style type="text/css">
    /* The outermost element*/
    .image-div {
        overflow: hidden;
    }
    .image-div img {
        height: 100vh;
        width: 100%;
        object-fit: cover;
    }
    .zoominheader {
        position: relative;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        -webkit-animation: zoomin 20s ease-in infinite;
        animation: zoomin 20s ease-in infinite;
        transition: all 0.5s ease-in-out;
        overflow: hidden;
    }

    /* The innermost element*/
    .zoomoutheader {
        width: 400px;
        height: 200px;
        text-align: center;
        background: none;
        -webkit-animation: zoomout 20s ease-in infinite;
        animation: zoomout 20s ease-in infinite;
        transition: all 0.5s ease-in-out;
        overflow: hidden;
    }

    /* Zoom in Keyframes */
    @-webkit-keyframes zoomin {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.5);
        }
        100% {
            transform: scale(1);
        }
    }
    @keyframes zoomin {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.5);
        }
        100% {
            transform: scale(1);
        }
    } /*End of Zoom in Keyframes */

    /* Zoom out Keyframes */
    @-webkit-keyframes zoomout {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(0.67);
        }
        100% {
            transform: scale(1);
        }
    }
    @keyframes zoomout {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(0.67);
        }
        100% {
            transform: scale(1);
        }
    } /*End of Zoom out Keyframes */

    /*Style for the text*/
    
</style>
<div class="header-wrapper">
    <div class="image-div">
        <!-- <div class="zoomoutheader"></div> -->
        <img src="https://i.pinimg.com/originals/47/0a/19/470a19a36904fe200610cc1f41eb00d9.jpg" class="img-fluid zoominheader" />
    </div>
</div>



 