<?php
$configs = DB::table('configs')->first();
?>

<style>
    .accordion-item {
        /* background-color: #ffffff; */
        border-radius: .4rem;
    }

    .accordion-link {
        font-size: 1rem;
        color: rgba(0, 0, 0, 0.8);
        text-decoration: none;
        /* background-color: #ffffff; */
        width: 100%;
        display: flex;
        align-items: center;
        /* justify-content:space-between; */
        justify-content: flex-start;
        padding: 1rem 0;
    }

    .accordion-link i {
        color: #e7d5ff;
        padding: .5rem;
    }

    .accordion-item .fa-angle-up {
        display: none;
    }

    .answer {
        position: relative;
        background-color: #fff;
        transition: max-height 50ms;
    }

    .answer.card_active {
        max-height: 0;
        overflow: hidden;
    }

    .answer::before {
        content: '';
        position: absolute;
        width: .6rem;
        /* height: 90%;
        background-color: #8fc460; */
        top: 50%;
        left: 0;
        transform: translateY(-50%);
    }

    .answer p {
        color: rgba(0, 0, 0, 0.6);
        font-size: 1rem;
    }

    .answer .p_filter {
        padding: 0 2rem;
    }

    .card_filter {
        max-height: 60rem !important;
    }

    .accordion-item.active .accordion-link .fas.fa-angle-down {
        display: none;
    }

    .accordion-item.active .accordion-link .fas.fa-angle-up {
        display: block;
    }

    .fas.fa-angle-up {
        color: #1b7c15;
    }

    @media (min-width: 650px) {
        .accordion-item .accordion-link .fas.fa-angle-down {
            display: none;
        }

        .accordion-item .accordion-link .fas.fa-angle-up {
            display: block;
        }

        .answer.card_active {
            max-height: 60rem !important;
            overflow: hidden;
        }
    }

    .dropdown {
        width: 100%;
        max-width: 15rem;
        /* margin: 0; */
        position: relative;
        color: white;
        text-transform: capitalize;
        font-size: 1rem;
        font-weight: bold;
        border-radius: 0px;
    }

    .dropdown__select {
        border-radius: inherit;
    }

    .dropdown__list {
        margin-top: 0rem;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        display: none;
    }

    .dropdown__list:before {
        content: "";
        height: 2.5rem;
        position: absolute;
        left: 0;
        right: 0;
        background-color: transparent;
        transform: translateY(-100%);
    }

    .dropdown:hover .dropdown__list {
        display: block;
    }

    .dropdown__select,
    .dropdown__item {
        width: 100%;
        padding: 0.6rem;
        background-color: #fff;
        color: #000;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
    }

    .dropdown__item {
        transition: background-color 0.2s linear;
    }

    .dropdown__item:first-child {
        border-radius: 4px 4px 0 0;
        position: relative;
    }

    .dropdown__item:first-child:before {
        content: "";
        position: absolute;
        top: 0;
        left: 3rem;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid #fff;
        transform: translateY(-100%);
        transition: border-color 0.2s linear;
    }

    .dropdown__item:first-child:hover:before {
        border-bottom-color: #d7d7d7;
    }

    .dropdown__item:last-child {
        border-radius: 0 0 4px 4px;
    }

    .dropdown__item:hover {
        color: #fff;
    }

</style>
