<style>
    h1 {
        text-align: center;
        margin: 2%;
    }

    .imageDiv {
        height: 450px;
        width: 100%;
        background-image: url("/DesafioDrible/images/index3.jpg");
        background-position: center;
        background-size: cover;
        padding-top: 100px;
    }

    .prodId {
        border-radius: 50%;
        max-width: 400px;
        height: auto;
    }

    .productId1 {
        position: absolute;
        left: 0%;
        width: 40%;
        max-height: 70%;
        padding: 10%;
    }

    .productId2 {
        position: absolute;
        max-width: 60%;
        max-height: 70%;
        left: 40%;
        padding: 8%;
    }

    .similarProds {
        background-color: #f9f9fa;
        position: absolute;
        align-content: center;
        width: 100%;
        top: 77%;
        height: 100%;
        padding: 5%;
    }

    .text-block {
        text-transform: uppercase;
        position: absolute;
        text-align: center;
        background-color: black;
        color: white;
        padding-left: 20px;
        padding-right: 20px;
    }

    .form-login {
        width: 400px;
        left: 50%;
        margin: -130px 0 0 -210px;
        padding: 5px;
        position: absolute;
        top: 50%;
    }

    main {
        margin: 1%;
        margin-top: 4%;
    }

    .column {
        float: left;
        width: 25%;
        padding: 0 10px;
    }

    .row {
        margin: 0 -5px;
    }

    @media screen and (max-width: 600px) {
        .column {
            width: 100%;
            display: block;
            margin-bottom: 20px;
        }
    }

    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 300px;
        margin: auto;
        text-align: center;
        font-family: arial;
    }

    .price {
        color: grey;
        font-size: 22px;
    }

    /* PAGINAÇÃO */
    .pagination {
        position: absolute;
        left: 46%;
        right: 46%;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
    }


    .pagination a.active {
        background-color: dodgerblue;
        color: white;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }

    .subscription {
        padding: 15px;
        text-align: center;
    }

    .tableSubscription {
        border: 1px solid #ddd;
    }

    .profile{
        background-color: #e6e6e6;
        height: 160px;
        width: 100%;
        padding: 2%;
    }

    .profile_foto {
        position: absolute;
        left: 5%;
    }

    .profile_name {
        position: absolute;
        left: 15%;
    }

    .tableProfile{
        margin-left: auto;
        margin-right: auto; 
    }

</style>