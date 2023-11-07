@extends('layouts.admin')
@section('content')
    @push('styles')
        <style>

            .page {
                page-break-before: always;
                margin-top: 20px;
                margin-bottom: 20px;
            }
            :root {
                --theme-color: #8fbf85;
                --title-color: #111111;
                --body-color: #6E6E6E;
                --smoke-color: #f3f3f3;
                --smoke-dark: #E1ECFF;
                --black-color: #000000;
                --white-color: #ffffff;
                --light-color: #72849B;
                --border-color: #C4C4C4;
                --title-font: 'Nunito Sans', sans-serif;
                --body-font: 'Nunito Sans', sans-serif;
                --main-container: 1380px;
                --container-gutters: 24px;
                --section-space: 50px;
                --section-title-space: 70px;
                --ripple-ani-duration: 5s
            }

            .restaurant-template {
                --theme-color: #EE1C25
            }

            .photography-template {
                --theme-color: #FB9F0D
            }

            .electronics-template,.it-template {
                --theme-color: #557497
            }

            .hall-template {
                --theme-color: #1A8E5F
            }

            .train-template {
                --theme-color: #7539FF
            }

            .hospital-template {
                --theme-color: #01B3F2
            }

            .hosting-template {
                --theme-color: #3865EF
            }

            .zoo-template {
                --theme-color: #00C764
            }

            .stadium-template {
                --theme-color: #B22C19
            }

            @use "sass:math";html,body {
                                 scroll-behavior: auto !important
                             }

            body {
                font-family: var(--title-font);
                font-size: 14px;
                font-weight: 400;
                color: var(--body-color);
                line-height: 22px;
                overflow-x: hidden;
                -webkit-font-smoothing: antialiased;
                background-color: #dbdbdb
            }

            iframe {
                border: none;
                width: 100%
            }

            .slick-slide:focus,button:focus,a:focus,a:active,input,input:hover,input:focus,input:active,textarea,textarea:hover,textarea:focus,textarea:active {
                outline: none
            }

            input:focus {
                outline: none;
                box-shadow: none
            }

            img:not([draggable]),embed,object,video {
                max-width: 100%;
                height: auto
            }

            ul {
                list-style-type: disc
            }

            ol {
                list-style-type: decimal
            }

            table {
                margin: 0 0 1.5em;
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                border: 1px solid var(--border-color)
            }

            th {
                font-weight: 700;
                color: var(--title-color)
            }

            td,th {
                border: 1px solid var(--border-color);
                padding: 9px 12px
            }

            a {
                color: var(--theme-color);
                text-decoration: none;
                outline: 0;
                -webkit-transition: all ease 0.4s;
                transition: all ease 0.4s
            }

            a:hover {
                color: var(--title-color)
            }

            a:active,a:focus,a:hover,a:visited {
                text-decoration: none;
                outline: 0
            }

            button {
                -webkit-transition: all ease 0.4s;
                transition: all ease 0.4s
            }

            img {
                border: none;
                max-width: 100%
            }

            ins {
                text-decoration: none
            }

            pre {
                font-family: var(--body-font);
                background: #f5f5f5;
                color: #666;
                font-size: 14px;
                margin: 20px 0;
                overflow: auto;
                padding: 20px;
                white-space: pre-wrap;
                word-wrap: break-word
            }

            span.ajax-loader:empty,p:empty {
                display: none
            }

            p {
                font-family: var(--body-font);
                margin: 0 0 18px 0;
                color: var(--body-color);
                line-height: 1.571
            }

            h1 a,h2 a,h3 a,h4 a,h5 a,h6 a,p a,span a {
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit
            }

            .h1,h1,.h2,h2,.h3,h3,.h4,h4,.h5,h5,.h6,h6 {
                font-family: var(--title-font);
                color: var(--title-color);
                text-transform: none;
                font-weight: 700;
                line-height: 1.4;
                margin: 0 0 15px 0
            }

            .h1,h1 {
                font-size: 60px;
                line-height: 1.167
            }

            .h2,h2 {
                font-size: 48px;
                line-height: 1.208
            }

            .h3,h3 {
                font-size: 36px;
                line-height: 1.278
            }

            .h4,h4 {
                font-size: 30px;
                line-height: 1.333;
                font-weight: 600
            }

            .h5,h5 {
                font-size: 24px;
                line-height: 1.417;
                font-weight: 600
            }

            .h6,h6 {
                font-size: 20px;
                line-height: 1.5;
                font-weight: 600
            }

            @media (max-width: 1399px) {
                .h1,h1 {
                    font-size:48px
                }

                .h2,h2 {
                    font-size: 40px
                }
            }

            @media (max-width: 1199px) {
                .h1,h1 {
                    font-size:40px
                }

                .h2,h2 {
                    font-size: 36px
                }

                .h3,h3 {
                    font-size: 30px
                }

                .h4,h4 {
                    font-size: 24px
                }

                .h5,h5 {
                    font-size: 20px
                }

                .h6,h6 {
                    font-size: 16px
                }
            }

            @media (max-width: 767px) {
                .h1,h1 {
                    font-size:40px
                }

                .h2,h2 {
                    font-size: 28px
                }

                .h3,h3 {
                    font-size: 26px
                }

                .h4,h4 {
                    font-size: 22px
                }

                .h5,h5 {
                    font-size: 18px
                }

                .h6,h6 {
                    font-size: 16px
                }
            }

            @media (max-width: 575px) {
                .h1,h1 {
                    font-size:34px;
                    line-height: 1.3
                }
            }

            @media (max-width: 375px) {
                .h1,h1 {
                    font-size:32px
                }
            }

            @media (max-width: 1399px) {
                :root {
                    --main-container: 850px
                }
            }

            .invoice-container {
                width: 880px;
                padding: 20px 15px;
                margin: 15px auto;
                position: relative;
                z-index: 5
            }

            .invoice-container-wrap {
                overflow: auto
            }

            .slick-track>[class*=col] {
                -webkit-flex-shrink: 0;
                -ms-flex-negative: 0;
                flex-shrink: 0;
                width: 100%;
                max-width: 100%;
                padding-right: calc(var(--bs-gutter-x)/ 2);
                padding-left: calc(var(--bs-gutter-x)/ 2);
                margin-top: var(--bs-gutter-y)
            }

            .gy-30 {
                --bs-gutter-y: 30px
            }

            .gy-40 {
                --bs-gutter-y: 40px
            }

            .gy-50 {
                --bs-gutter-y: 50px
            }

            .gx-10 {
                --bs-gutter-x: 10px
            }

            @media (min-width: 1500px) {
                .gx-60 {
                    --bs-gutter-x: 60px
                }
            }

            @media (min-width: 1399px) {
                .gx-30 {
                    --bs-gutter-x: 30px
                }

                .gx-25 {
                    --bs-gutter-x: 25px
                }

                .gx-40 {
                    --bs-gutter-x: 40px
                }
            }

            @media (max-width: 991px) {
                .gy-50 {
                    --bs-gutter-y: 40px
                }
            }

            .px-5 {
                padding-right: 5px;
                padding-left: 5px
            }

            .px-10 {
                padding-right: 10px;
                padding-left: 10px
            }

            .px-15 {
                padding-right: 15px;
                padding-left: 15px
            }

            .px-20 {
                padding-right: 20px;
                padding-left: 20px
            }

            .px-25 {
                padding-right: 25px;
                padding-left: 25px
            }

            .px-30 {
                padding-right: 30px;
                padding-left: 30px
            }

            .px-35 {
                padding-right: 35px;
                padding-left: 35px
            }

            .px-40 {
                padding-right: 40px;
                padding-left: 40px
            }

            .px-45 {
                padding-right: 45px;
                padding-left: 45px
            }

            .px-50 {
                padding-right: 50px;
                padding-left: 50px
            }

            .py-5 {
                padding-top: 5px;
                padding-bottom: 5px
            }

            .py-10 {
                padding-top: 10px;
                padding-bottom: 10px
            }

            .py-15 {
                padding-top: 15px;
                padding-bottom: 15px
            }

            .py-20 {
                padding-top: 20px;
                padding-bottom: 20px
            }

            .py-25 {
                padding-top: 25px;
                padding-bottom: 25px
            }

            .py-30 {
                padding-top: 30px;
                padding-bottom: 30px
            }

            .py-35 {
                padding-top: 35px;
                padding-bottom: 35px
            }

            .py-40 {
                padding-top: 40px;
                padding-bottom: 40px
            }

            .py-45 {
                padding-top: 45px;
                padding-bottom: 45px
            }

            .py-50 {
                padding-top: 50px;
                padding-bottom: 50px
            }

            .pt-5 {
                padding-top: 5px
            }

            .pt-10 {
                padding-top: 10px
            }

            .pt-15 {
                padding-top: 15px
            }

            .pt-20 {
                padding-top: 20px
            }

            .pt-25 {
                padding-top: 25px
            }

            .pt-30 {
                padding-top: 30px
            }

            .pt-35 {
                padding-top: 35px
            }

            .pt-40 {
                padding-top: 40px
            }

            .pt-45 {
                padding-top: 45px
            }

            .pt-50 {
                padding-top: 50px
            }

            .pb-5 {
                padding-bottom: 5px
            }

            .pb-10 {
                padding-bottom: 10px
            }

            .pb-15 {
                padding-bottom: 15px
            }

            .pb-20 {
                padding-bottom: 20px
            }

            .pb-25 {
                padding-bottom: 25px
            }

            .pb-30 {
                padding-bottom: 30px
            }

            .pb-35 {
                padding-bottom: 35px
            }

            .pb-40 {
                padding-bottom: 40px
            }

            .pb-45 {
                padding-bottom: 45px
            }

            .pb-50 {
                padding-bottom: 50px
            }

            .pl-5 {
                padding-left: 5px
            }

            .pl-10 {
                padding-left: 10px
            }

            .pl-15 {
                padding-left: 15px
            }

            .pl-20 {
                padding-left: 20px
            }

            .pl-25 {
                padding-left: 25px
            }

            .pl-30 {
                padding-left: 30px
            }

            .pl-35 {
                padding-left: 35px
            }

            .pl-40 {
                padding-left: 40px
            }

            .pl-45 {
                padding-left: 45px
            }

            .pl-50 {
                padding-left: 50px
            }

            .pr-5 {
                padding-right: 5px
            }

            .pr-10 {
                padding-right: 10px
            }

            .pr-15 {
                padding-right: 15px
            }

            .pr-20 {
                padding-right: 20px
            }

            .pr-25 {
                padding-right: 25px
            }

            .pr-30 {
                padding-right: 30px
            }

            .pr-35 {
                padding-right: 35px
            }

            .pr-40 {
                padding-right: 40px
            }

            .pr-45 {
                padding-right: 45px
            }

            .pr-50 {
                padding-right: 50px
            }

            .mx-5 {
                margin-right: 5px;
                margin-left: 5px
            }

            .mx-10 {
                margin-right: 10px;
                margin-left: 10px
            }

            .mx-15 {
                margin-right: 15px;
                margin-left: 15px
            }

            .mx-20 {
                margin-right: 20px;
                margin-left: 20px
            }

            .mx-25 {
                margin-right: 25px;
                margin-left: 25px
            }

            .mx-30 {
                margin-right: 30px;
                margin-left: 30px
            }

            .mx-35 {
                margin-right: 35px;
                margin-left: 35px
            }

            .mx-40 {
                margin-right: 40px;
                margin-left: 40px
            }

            .mx-45 {
                margin-right: 45px;
                margin-left: 45px
            }

            .mx-50 {
                margin-right: 50px;
                margin-left: 50px
            }

            .my-5 {
                margin-top: 5px;
                margin-bottom: 5px
            }

            .my-10 {
                margin-top: 10px;
                margin-bottom: 10px
            }

            .my-15 {
                margin-top: 15px;
                margin-bottom: 15px
            }

            .my-20 {
                margin-top: 20px;
                margin-bottom: 20px
            }

            .my-25 {
                margin-top: 25px;
                margin-bottom: 25px
            }

            .my-30 {
                margin-top: 30px;
                margin-bottom: 30px
            }

            .my-35 {
                margin-top: 35px;
                margin-bottom: 35px
            }

            .my-40 {
                margin-top: 40px;
                margin-bottom: 40px
            }

            .my-45 {
                margin-top: 45px;
                margin-bottom: 45px
            }

            .my-50 {
                margin-top: 50px;
                margin-bottom: 50px
            }

            .mt-5 {
                margin-top: 5px
            }

            .mt-10 {
                margin-top: 10px
            }

            .mt-15 {
                margin-top: 15px
            }

            .mt-20 {
                margin-top: 20px
            }

            .mt-25 {
                margin-top: 25px
            }

            .mt-30 {
                margin-top: 30px
            }

            .mt-35 {
                margin-top: 35px
            }

            .mt-40 {
                margin-top: 40px
            }

            .mt-45 {
                margin-top: 45px
            }

            .mt-50 {
                margin-top: 50px
            }

            .mb-5 {
                margin-bottom: 5px
            }

            .mb-10 {
                margin-bottom: 10px
            }

            .mb-15 {
                margin-bottom: 15px
            }

            .mb-20 {
                margin-bottom: 20px
            }

            .mb-25 {
                margin-bottom: 25px
            }

            .mb-30 {
                margin-bottom: 30px
            }

            .mb-35 {
                margin-bottom: 35px
            }

            .mb-40 {
                margin-bottom: 40px
            }

            .mb-45 {
                margin-bottom: 45px
            }

            .mb-50 {
                margin-bottom: 50px
            }

            .ml-5 {
                margin-left: 5px
            }

            .ml-10 {
                margin-left: 10px
            }

            .ml-15 {
                margin-left: 15px
            }

            .ml-20 {
                margin-left: 20px
            }

            .ml-25 {
                margin-left: 25px
            }

            .ml-30 {
                margin-left: 30px
            }

            .ml-35 {
                margin-left: 35px
            }

            .ml-40 {
                margin-left: 40px
            }

            .ml-45 {
                margin-left: 45px
            }

            .ml-50 {
                margin-left: 50px
            }

            .mr-5 {
                margin-right: 5px
            }

            .mr-10 {
                margin-right: 10px
            }

            .mr-15 {
                margin-right: 15px
            }

            .mr-20 {
                margin-right: 20px
            }

            .mr-25 {
                margin-right: 25px
            }

            .mr-30 {
                margin-right: 30px
            }

            .mr-35 {
                margin-right: 35px
            }

            .mr-40 {
                margin-right: 40px
            }

            .mr-45 {
                margin-right: 45px
            }

            .mr-50 {
                margin-right: 50px
            }

            .mb-60 {
                margin-bottom: 60px
            }

            .mt-n1 {
                margin-top: -.25rem
            }

            .mt-n2 {
                margin-top: -.6rem
            }

            .mt-n3 {
                margin-top: -1rem
            }

            .mt-n4 {
                margin-top: -1.5rem
            }

            .mt-n5 {
                margin-top: -3rem
            }

            .mb-n1 {
                margin-bottom: -.25rem
            }

            .mb-n2 {
                margin-bottom: -.6rem
            }

            .mb-n3 {
                margin-bottom: -1rem
            }

            .mb-n4 {
                margin-bottom: -1.5rem
            }

            .mb-n5 {
                margin-bottom: -3rem
            }

            .space,.space-top {
                padding-top: var(--section-space)
            }

            .space,.space-bottom {
                padding-bottom: var(--section-space)
            }

            .invoice-number,.invoice-date {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: justify;
                -webkit-justify-content: space-between;
                -ms-flex-pack: justify;
                justify-content: space-between;
            }

            .th-invoice {
                position: relative;
                z-index: 4;
                background-color: var(--white-color)
            }

            .th-invoice .download-inner {
                padding: 50px
            }

            .th-invoice b {
                color: var(--title-color)
            }

            .th-invoice .big-title {
                font-size: 44px;
                text-transform: uppercase;
                margin-bottom: 0;
                text-align: left;
                font-weight: 800
            }

            .th-invoice .header-bottom {
                margin-top: 22px;
                margin-bottom: 19px
            }

            .th-invoice .invoice-left b,.th-invoice .invoice-right b {
                font-size: 18px;
                font-weight: 700
            }

            .th-invoice .invoice-left.text-white p,.th-invoice .invoice-left.text-white b,.th-invoice .invoice-right.text-white p,.th-invoice .invoice-right.text-white b {
                color: var(--white-color)
            }

            .th-invoice address {
                margin-bottom: 0
            }

            .invoice-right {
                text-align: right
            }

            .invoice-table {
                border: none;
                margin-bottom: 25px
            }

            .invoice-table th {
                color: var(--title-color)
            }

            .invoice-table th,.invoice-table td {
                padding: 13px 20px;
                border: none
            }

            .invoice-table th:first-child,.invoice-table td:first-child {
                width: 56px
            }

            .invoice-table th:nth-last-child(-n+3),.invoice-table td:nth-last-child(-n+3) {
                width: 108px
            }

            .invoice-table th:last-child,.invoice-table td:last-child {
                text-align: right
            }

            .invoice-table tr {
                border-bottom: 1px solid var(--border-color);
                position: relative
            }

            .invoice-table thead tr {
                border-bottom: none
            }

            .invoice-table th {
                background-color: var(--theme-color);
                color: var(--white-color);
                font-size: 16px
            }

            .invoice-table th:first-child {
                border-radius: 0
            }

            .invoice-table th:last-child {
                border-radius: 0
            }

            .invoice-table tfoot td,.invoice-table tfoot th {
                text-align: right !important
            }

            .invoice-table.td-big tbody td {
                padding: 23px 20px
            }

            .invoice-table.style2 thead th,.invoice-table.style2 thead td {
                background: -webkit-linear-gradient(bottom, #21171F 0%, #3E4049 100%);
                background: linear-gradient(0deg, #21171F 0%, #3E4049 100%)
            }

            .invoice-table.style2 tbody td {
                padding: 23px 20px;
                background-color: #F5F5F5
            }

            .invoice-table.style2 tr {
                border-bottom: 1px solid var(--white-color)
            }

            .invoice-table.mb-30 {
                margin-bottom: 30px
            }

            .table-stripe thead th,.table-stripe thead td {
                background-color: var(--smoke-dark)
            }

            .table-stripe tr {
                border-bottom: none
            }

            .table-stripe tr:nth-child(2n) th,.table-stripe tr:nth-child(2n) td {
                background-color: var(--smoke-color)
            }

            .table-stripe tr:nth-child(2n) th:first-child,.table-stripe tr:nth-child(2n) td:first-child {
                border-radius: 0
            }

            .table-stripe tr:nth-child(2n) th:last-child,.table-stripe tr:nth-child(2n) td:last-child {
                border-radius: 0
            }

            .table-style1 {
                border: 1px solid var(--smoke-color);
                margin-top: -10px
            }

            .table-style1 tr th,.table-style1 tr td {
                text-align: left !important;
                border-radius: 0 !important;
                border-bottom: 1px solid var(--smoke-color);
                width: 32.90%
            }

            .table-style1 thead {
                background-color: var(--smoke-color)
            }

            .table-style1 thead th,.table-style1 thead td {
                border-right: 1px solid var(--border-color)
            }

            .table-style1 thead th:last-child,.table-style1 thead td:last-child {
                border-right: none
            }

            .table-style2 b,.table-style2 th {
                font-weight: 600
            }

            .table-style2 th,.table-style2 td {
                border-radius: 0 !important;
                border-right: 1px solid var(--smoke-color);
                padding: 4px 20px
            }

            .table-style2 th:first-child,.table-style2 td:first-child {
                border-left: 1px solid var(--smoke-color)
            }

            .table-style2 td {
                font-size: 12px
            }

            .table-style2 td:last-child {
                text-align: left
            }

            .table-style2 tr {
                border-bottom: none
            }

            .table-style2 tr:last-child {
                border-bottom: 1px solid var(--smoke-color)
            }

            .table-style2 tr:last-child th,.table-style2 tr:last-child td {
                padding-bottom: 15px
            }

            .table-style2 tr:first-child {
                border-top: 1px solid var(--smoke-color)
            }

            .table-style2 tr:first-child th,.table-style2 tr:first-child td {
                padding-top: 15px
            }

            .total-table {
                border: none;
                margin-bottom: 0;
                margin-top: -4px
            }

            .total-table th {
                font-size: 18px
            }

            .total-table th,.total-table td {
                border: none;
                padding: 4px 20px
            }

            .total-table th:nth-child(2),.total-table td:nth-child(2) {
                text-align: right
            }

            .total-table tr:last-child {
                border-top: 1px solid var(--border-color)
            }

            .total-table tr:last-child th,.total-table tr:last-child td {
                padding: 15px 20px
            }

            .total-table tr:nth-last-child(2) th,.total-table tr:nth-last-child(2) td {
                padding: 4px 20px 16px 20px
            }

            hr.style1 {
                margin-top: 24px;
                margin-bottom: 24px;
                background-color: var(--border-color);
                opacity: 1
            }

            .table-title {
                font-size: 18px;
                margin-bottom: 7px
            }

            .text-title {
                color: var(--title-color);
                font-weight: 500
            }

            .invoice-note {
                border-top: 1px solid var(--border-color);
                border-bottom: 1px solid var(--border-color);
                padding-top: 15px;
                padding-bottom: 15px;
                text-align: center
            }

            .invoice-note svg {
                margin-right: 5px;
                margin-top: -3px
            }

            .invoice-note b {
                margin-right: 5px
            }

            .invoice-note2 {
                margin-right: 3px
            }

            .background-image {
                background-size: 100% 100%
            }

            .body-shape1,.body-shape2,.body-shape3,.body-shape4 {
                position: absolute;
                z-index: -1;
                left: 0
            }

            .body-shape1 img,.body-shape2 img,.body-shape3 img,.body-shape4 img {
                width: 100%
            }

            .invoice-buttons {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: center;
                -webkit-justify-content: center;
                -ms-flex-pack: center;
                justify-content: center;
                gap: 3px;
                padding: 3px;
                overflow: hidden;
                margin-top: 45px;
                position: relative;
                top: -50px;
                background-color: var(--white-color);
                box-shadow: 0px 0px 15px rgba(119,119,119,0.25);
                border-radius: 10px;
                max-width: 129px;
                margin-left: auto;
                margin-right: auto
            }

            .invoice-buttons a,.invoice-buttons button {
                border: none;
                height: 46px;
                width: 60px;
                line-height: 44px;
                text-align: center;
                border-radius: 7px 0 0 7px;
                -webkit-transition: 0.3s ease-in-out;
                transition: 0.3s ease-in-out;
                background-color: transparent;
                position: relative;
                z-index: 2
            }

            .invoice-buttons a::before,.invoice-buttons button::before {
                content: '';
                position: absolute;
                inset: 0;
                background-color: var(--theme-color);
                opacity: 0.25;
                border-radius: inherit;
                z-index: -1;
                -webkit-transition: 0.4s ease-in-out;
                transition: 0.4s ease-in-out
            }

            .invoice-buttons a svg path,.invoice-buttons button svg path {
                -webkit-transition: 0.3s ease-in-out;
                transition: 0.3s ease-in-out
            }

            .invoice-buttons a:hover:before,.invoice-buttons button:hover:before {
                opacity: 1;
                background-color: var(--title-color)
            }

            .invoice-buttons a:hover svg path,.invoice-buttons button:hover svg path {
                fill: #fff
            }

            .invoice-buttons .download_btn {
                border-radius: 0 7px 7px 0
            }

            .invoice-buttons .download_btn:before {
                opacity: 1
            }

            .invoice-buttons .download_btn:hover:before {
                background-color: var(--title-color)
            }

            .body-bg {
                position: absolute;
                inset: 0;
                z-index: -1
            }

            .body-bg img {
                height: 100%;
                width: 100%
            }

            @media print {
                .invoice-buttons {
                    opacity: 0 !important
                }

                .th-invoice .download-inner {
                    padding: 0;
                    padding-top: 40px
                }

                .invoice-container {
                    width: 100%;
                    max-width: 880px
                }

                .invoice-container-wrap {
                    overflow-x: hidden
                }

                .invoice_style2 .body-shape2 {
                    bottom: -50px
                }

                .invoice-table th {
                    color: black !important
                }

                .invoice-table tr {
                    border-color: #e6e6e6 !important
                }

                .invoice-table th,.invoice-table td {
                    border: 1px solid #e6e6e6 !important;
                    border-color: #e6e6e6 !important
                }
            }

            .invoice_style1 {
                padding-bottom: 1px
            }

            .invoice-number {
                margin-bottom: 0
            }

            .invoice-date {
                margin-bottom: 0
            }

            .invoice_style1 {
                padding-bottom: 36px
            }

            .invoice_style1 .logo-shape {
                position: absolute;
                right: 0;
                top: 20px;
                z-index: -3
            }

            .invoice_style1 .right-shape {
                position: absolute;
                right: 0;
                top: 93px;
                z-index: -1
            }

            .invoice_style1 .left-shape {
                position: absolute;
                top: 93px;
                left: 0;
                z-index: -1
            }

            .invoice_style1 .header-logo {
                margin-top: -17px
            }

            .invoice_style1 .big-title {
                font-size: 54px;
                color: var(--white-color);
                margin-top: 8px
            }

            .invoice_style1 .invoice-number,.invoice_style1 .invoice-date {
                font-size: 18px;
                color: var(--white-color)
            }

            .invoice_style1 .invoice-number b,.invoice_style1 .invoice-date b {
                color: var(--white-color)
            }

            .invoice_style1 .invoice-number {
                margin-top: 8px;
                margin-bottom: 5px
            }

            .invoice_style1 .header-bottom {
                margin-bottom: 50px
            }

            .invoice_style1 .body-shape1 {
                width: 100%;
                position: absolute;
                bottom: 0;
                left: 0
            }

            .invoice_style2 {
                padding-bottom: 10px
            }

            .invoice_style2 .header-logo {
                margin-top: -20px
            }

            .invoice_style2 .big-title {
                margin-top: -0.1em;
                margin-bottom: 12px
            }

            .invoice_style2 .body-shape1 {
                top: 0;
                width: 100%
            }

            .invoice_style2 .body-shape2 {
                bottom: 0
            }

            .invoice_style2 .total-table tr:last-child {
                background: -webkit-linear-gradient(bottom, #21171F 0%, #3E4049 100%);
                background: linear-gradient(0deg, #21171F 0%, #3E4049 100%)
            }

            .invoice_style2 .total-table tr:last-child th,.invoice_style2 .total-table tr:last-child td {
                color: var(--white-color)
            }

            .invoice_style2 .invoice-buttons {
                margin-bottom: 30px;
                margin-left: 508px;
                margin-top: 30px
            }

            .invoice_style2 .footer-info {
                position: absolute;
                bottom: 0;
                left: 0;
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
                padding: 23px 50px
            }

            .invoice_style2 .footer-info p {
                margin-right: 25px;
                color: var(--white-color)
            }

            .invoice_style2 .footer-info svg {
                margin-right: 3px
            }

            .invoice_style3 .big-title {
                font-size: 70px;
                color: var(--white-color);
                margin-top: -0.18em
            }

            .invoice_style3 .body-shape1 {
                top: 0;
                right: 0;
                left: unset
            }

            .invoice_style3 .body-shape2 {
                bottom: 150px
            }

            .invoice_style3 .invoice-table thead th,.invoice_style3 .invoice-table thead td {
                background: -webkit-linear-gradient(top, #BED5EF -35.51%, #557497 86.64%);
                background: linear-gradient(180deg, #BED5EF -35.51%, #557497 86.64%)
            }

            .invoice_style3 .invoice-table {
                margin-bottom: 30px
            }

            .invoice_style3 .invoice-buttons {
                margin-top: 35px
            }

            .table-stripe-column tbody {
                background-color: #f5f5f5
            }

            .table-stripe-column tbody th:nth-child(odd),.table-stripe-column tbody td:nth-child(odd) {
                background-color: #E7E9ED
            }

            .table-stripe-column th:nth-last-child(-n+3),.table-stripe-column td:nth-last-child(-n+3) {
                text-align: center
            }

            .table-stripe-column tr:last-child {
                border-bottom: none
            }

            .invoice_style4 {
                padding-bottom: 60px
            }

            .invoice_style4 .body-shape1 {
                top: 0
            }

            .invoice_style4 .th-header {
                margin-top: -37px;
                margin-bottom: 63px
            }

            .invoice_style4 .th-header b {
                font-size: 18px
            }

            .invoice_style4 .big-title {
                margin-bottom: 33px
            }

            .invoice_style4 .total-table {
                background-color: var(--smoke-color)
            }

            .invoice_style4 .total-table tr {
                border-top: none
            }

            .invoice_style4 .total-table th {
                padding-left: 500px !important
            }

            .invoice_style4 .footer-info {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                background-color: var(--theme-color);
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: justify;
                -webkit-justify-content: space-between;
                -ms-flex-pack: justify;
                justify-content: space-between;
                padding: 20px 50px 20px 80px;
                border-radius: 35px 0 0 0;
                z-index: -2
            }

            .invoice_style4 .footer-info:before {
                content: '';
                position: absolute;
                inset: 0;
                left: 30px;
                background-color: #242437;
                z-index: -1;
                border-radius: inherit
            }

            .invoice_style4 .footer-info svg {
                margin-right: 4px
            }

            .invoice_style4 .footer-info p {
                color: var(--white-color)
            }

            .invoice-table.style3 {
                table-layout: fixed
            }

            .invoice-table.style3 th:first-child,.invoice-table.style3 td:first-child {
                width: unset
            }

            .invoice-table.style3 th:nth-last-child(-n+3),.invoice-table.style3 td:nth-last-child(-n+3) {
                width: unset
            }

            .invoice-table.style3 th,.invoice-table.style3 td {
                width: 25%
            }

            .invoice-table.style3 th:nth-child(3),.invoice-table.style3 td:nth-child(3) {
                width: 100px
            }

            .invoice-table.style3 tr {
                border-bottom: none
            }

            .invoice-table.style3 th {
                background-color: #242437
            }

            .invoice-table.style3 th:last-child {
                text-align: left
            }

            .invoice-table.style3 td {
                background-color: var(--smoke-color)
            }

            .invoice-table.style3 td:last-child {
                text-align: left
            }

            .table-stripe3 {
                border: 1px solid var(--smoke-color)
            }

            .table-stripe3 thead tr {
                border-bottom: 1px solid var(--smoke-dark)
            }

            .table-stripe3 tr {
                border-bottom: 1px solid var(--smoke-color)
            }

            .table-stripe3 tr th,.table-stripe3 tr td {
                border-right: 1px solid var(--border-color)
            }

            .table-stripe3 tr th:nth-child(2),.table-stripe3 tr td:nth-child(2) {
                text-align: left
            }

            .table-stripe3 tr th:last-child,.table-stripe3 tr td:last-child {
                border-right: none
            }

            .table-stripe3 tr:nth-child(even) th,.table-stripe3 tr:nth-child(even) td {
                background-color: var(--smoke-color)
            }

            .table-stripe3 thead th,.table-stripe3 thead td {
                background-color: var(--smoke-dark) !important;
                border-radius: 0 !important;
                border-top: 1px solid #E0E0E0
            }

            .invoice_style5 {
                padding-bottom: 30px
            }

            .invoice_style5 .th-header {
                margin-bottom: 35px
            }

            .invoice_style5 .total-table {
                background-color: var(--smoke-color)
            }

            .invoice_style5 .total-table tr {
                border-top: none
            }

            .invoice_style5 .total-table th {
                padding-left: 500px !important
            }

            .header-layout4 .big-title,.header-layout5 .big-title {
                margin-top: -0.18em;
                margin-bottom: 15px
            }

            .invoice-table.style4 {
                --border-color: #fff
            }

            .invoice-table.style4 th,.invoice-table.style4 td {
                border-right: 1px solid var(--white-color)
            }

            .invoice-table.style4 th:nth-last-child(-n+3),.invoice-table.style4 th:first-child,.invoice-table.style4 td:nth-last-child(-n+3),.invoice-table.style4 td:first-child {
                width: unset;
                text-align: left
            }

            .invoice-table.style4 td {
                background-color: var(--smoke-color)
            }

            .invoice-table.style4 .blank-row td {
                background-color: var(--white-color)
            }

            .invoice_style7,.invoice_style6 {
                padding-bottom: 75px
            }

            .invoice_style7 .body-shape1,.invoice_style6 .body-shape1 {
                top: 0
            }

            .invoice_style7 .body-shape2,.invoice_style6 .body-shape2 {
                bottom: 0
            }

            .invoice_style7 .th-header,.invoice_style6 .th-header {
                margin-bottom: 35px
            }

            .invoice_style7 .big-title,.invoice_style6 .big-title {
                margin-top: -0.18em;
                margin-bottom: 15px
            }

            .invoice_style7 .total-table tr:last-child,.invoice_style6 .total-table tr:last-child {
                background: -webkit-linear-gradient(bottom, #21171F 0%, #3E4049 100%);
                background: linear-gradient(0deg, #21171F 0%, #3E4049 100%)
            }

            .invoice_style7 .total-table tr:last-child th,.invoice_style7 .total-table tr:last-child td,.invoice_style6 .total-table tr:last-child th,.invoice_style6 .total-table tr:last-child td {
                color: var(--white-color)
            }

            .invoice_style7 .footer-info,.invoice_style6 .footer-info {
                position: absolute;
                right: 50px;
                bottom: 22px;
                text-align: right
            }

            .invoice_style7 .footer-info p,.invoice_style6 .footer-info p {
                margin-top: 10px;
                color: var(--white-color)
            }

            .address-bg1 {
                background-color: var(--smoke-color);
                padding: 25px 30px
            }

            .table-stripe4 th,.table-stripe4 td {
                border-right: 1px solid #e0e0e0
            }

            .table-stripe4 th:nth-last-child(-n+3),.table-stripe4 th:first-child,.table-stripe4 td:nth-last-child(-n+3),.table-stripe4 td:first-child {
                width: unset;
                text-align: left
            }

            .table-stripe4 th:first-child,.table-stripe4 td:first-child {
                border-left: 1px solid #e0e0e0
            }

            .table-stripe4 th {
                background-image: -webkit-linear-gradient(top, #BED5EF -35.51%, #557497 86.64%);
                background-image: linear-gradient(180deg, #BED5EF -35.51%, #557497 86.64%)
            }

            .table-stripe4 tr {
                border-bottom: 1px solid #E7E9ED
            }

            .table-stripe4 tr:nth-child(even) {
                background-color: #E7E9ED
            }

            .table-stripe4.theme-color th {
                background-image: none
            }

            .invoice_style7 {
                padding-bottom: 0;
                border-bottom: 15px solid var(--theme-color)
            }

            .invoice_style7 .address-box {
                padding: 15px 20px
            }

            .invoice_style7 .address-left {
                border-right: none;
                border-radius: 0
            }

            .invoice_style7 .address-right {
                border-radius: 0
            }

            .invoice_style7 .address-middle {
                border-right: none
            }

            .invoice_style7 .table2 {
                margin-top: 30px
            }

            .invoice_style7 .th-header {
                margin-top: 50px;
                padding-right: 30px
            }

            .invoice_style7 .total-table tr:last-child {
                background-image: none;
                background-color: var(--theme-color)
            }

            .table-style3 {
                --smoke-color: #E7E9ED;
                border: 1px solid var(--smoke-color)
            }

            .table-style3 tr {
                border-bottom: 1px solid var(--smoke-color)
            }

            .table-style3 tr:nth-child(odd) th,.table-style3 tr:nth-child(odd) td {
                background-color: var(--smoke-color)
            }

            .table-style3 th,.table-style3 td {
                border-right: 1px solid #f5f5f5;
                width: 27%;
                padding: 11px
            }

            .table-style3 th:last-child,.table-style3 td:last-child {
                border-right: none;
                text-align: left
            }

            .table-style3 th:first-child,.table-style3 td:first-child {
                width: 19%
            }

            .invoice_style8 {
                --border-color: #DADADA
            }

            .invoice_style8 .invoice-table {
                --border-color: #DADADA;
                text-align: center
            }

            .invoice_style8 .invoice-table tbody tr:last-child {
                border-bottom: 1px solid var(--border-color)
            }

            .invoice_style8 .invoice-table tbody,.invoice_style8 .invoice-table tfoot {
                background-color: #F9F9F9
            }

            .total-table3 {
                border: none
            }

            .total-table3 th,.total-table3 td {
                border: none;
                padding: 5px 45px
            }

            .total-table3 th:last-child,.total-table3 td:last-child {
                text-align: right;
                padding-right: 20px
            }

            .table-style4 {
                border: 1px solid var(--smoke-color)
            }

            .table-style4 thead tr {
                border-bottom: 1px solid var(--smoke-dark)
            }

            .table-style4 thead th {
                border-radius: 0 !important
            }

            .table-style4 tr {
                border-bottom: none
            }

            .table-style4 th,.table-style4 td {
                text-align: center;
                border-right: 1px solid var(--border-color);
                width: 21%
            }

            .table-style4 th:last-child,.table-style4 td:last-child {
                border-right: none;
                text-align: center
            }

            .table-style4 th:first-child,.table-style4 td:first-child {
                width: 37%
            }

            .invoice_style9 {
                --border-color: #DADADA;
                padding-bottom: 50px
            }

            .invoice_style9 .invoice-table th {
                background: -webkit-linear-gradient(top, #01B3F2 0%, #6327ED 100%);
                background: linear-gradient(180deg, #01B3F2 0%, #6327ED 100%)
            }

            .invoice_style9 .invoice-table.style4 {
                border: 1px solid var(--smoke-color);
                border-top: none
            }

            .invoice_style9 .invoice-table.style4 th:last-child,.invoice_style9 .invoice-table.style4 td:last-child {
                border-right: 1px solid var(--smoke-color)
            }

            .invoice_style9 .invoice-table.style4 tr:last-child {
                border-bottom: 1px solid var(--smoke-color)
            }

            .invoice_style9 .table-stripe-column {
                text-align: center
            }

            .invoice_style9 .table-stripe-column tbody tr:last-child {
                border-bottom: 1px solid var(--border-color)
            }

            .invoice_style9 .table-stripe-column tbody,.invoice_style9 .table-stripe-column tfoot {
                background-color: #F9F9F9
            }

            .invoice_style9 .footer-info {
                position: absolute;
                bottom: 0;
                left: 50px;
                width: calc(100% - 100px);
                background-image: -webkit-linear-gradient(top, #01B3F2 0%, #6327ED 100%);
                background-image: linear-gradient(180deg, #01B3F2 0%, #6327ED 100%);
                border-radius: 100px 100px 0px 0px;
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: justify;
                -webkit-justify-content: space-between;
                -ms-flex-pack: justify;
                justify-content: space-between;
                padding: 15px 50px;
                z-index: -2
            }

            .invoice_style9 .footer-info svg {
                margin-right: 4px
            }

            .invoice_style9 .footer-info p {
                color: var(--white-color)
            }

            .invoice_style9 .invoice-buttons a::before,.invoice_style9 .invoice-buttons button::before {
                background: -webkit-linear-gradient(top, #01B3F2 0%, #6327ED 100%);
                background: linear-gradient(180deg, #01B3F2 0%, #6327ED 100%)
            }

            .invoice_style10 {
                --border-color: #DADADA;
                border-bottom: 10px solid;
                -webkit-border-image: -webkit-linear-gradient(357.43deg, #565BED 0%, #A664E8 100%);
                border-image: linear-gradient(92.57deg, #565BED 0%, #A664E8 100%);
                border-image-slice: 1
            }

            .invoice_style10 .big-title {
                margin-bottom: 10px
            }

            .invoice_style10 .th-header p,.invoice_style10 .th-header b,.invoice_style10 .th-header .big-title {
                color: var(--white-color)
            }

            .invoice_style10 .th-header .header-logo {
                margin-top: 35px
            }

            .invoice_style10 .table-style5 th {
                background-color: transparent
            }

            .invoice_style10 .table-style5 thead tr {
                background-image: -webkit-linear-gradient(357.43deg, #565BED 0%, #A664E8 100%);
                background-image: linear-gradient(92.57deg, #565BED 0%, #A664E8 100%)
            }

            .invoice_style10 .body-shape1 {
                top: 0
            }

            .invoice_style10 .invoice-buttons a::before,.invoice_style10 .invoice-buttons button::before {
                background-image: -webkit-linear-gradient(357.43deg, #565BED 0%, #A664E8 100%);
                background-image: linear-gradient(92.57deg, #565BED 0%, #A664E8 100%)
            }

            .table-style5 {
                table-layout: fixed
            }

            .table-style5 th,.table-style5 td {
                padding: 13px 25px
            }

            .table-style5 th:first-child,.table-style5 td:first-child {
                width: 60px;
                padding: 13px;
                text-align: center;
                background-color: #242437 !important;
                color: var(--white-color);
                border-bottom: 1px solid #242437
            }

            .table-style5 th:nth-last-child(-n+3),.table-style5 td:nth-last-child(-n+3) {
                width: unset
            }

            .table-style5 th:nth-child(2),.table-style5 td:nth-child(2) {
                width: 50%
            }

            .table-style5 tbody {
                background-color: #f5f5f5
            }

            .table-style5 tbody th:nth-child(odd),.table-style5 tbody td:nth-child(odd) {
                background-color: #E7E9ED
            }

            .table-style5 tr:last-child {
                border-bottom: none
            }

            .table-style5 tbody tr:last-child {
                border-bottom: 1px solid var(--border-color)
            }

            .table-style5 tbody,.table-style5 tfoot {
                background-color: #F9F9F9
            }

            .table-style5 .text-start {
                text-align: left !important
            }

            .header-layout8 {
                background-color: var(--theme-color);
                padding: 15px 30px;
                border-radius: 999px
            }

            .header-layout8 .big-title {
                color: var(--white-color);
                margin-bottom: -0.1em
            }

            .invoice_style11 {
                --border-color: #DADADA;
                --info-width: 186px;
                padding-bottom: 15px
            }

            .invoice_style11 .header-bottom {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-pack: end;
                -webkit-justify-content: flex-end;
                -ms-flex-pack: end;
                justify-content: flex-end;
                -webkit-box-align: center;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
                padding-right: 30px;
                margin-top: 15px;
                margin-bottom: 55px
            }

            .invoice_style11 .body-shape1 {
                top: 0
            }

            .invoice_style11 .body-shape2 {
                bottom: 0;
                left: 50px;
                line-height: 0
            }

            .invoice_style11 .table-stripe-column {
                --border-color: #DADADA;
                text-align: center;
                table-layout: fixed
            }

            .invoice_style11 .table-stripe-column tbody tr:last-child {
                border-bottom: 1px solid var(--border-color)
            }

            .invoice_style11 .table-stripe-column tbody,.invoice_style11 .table-stripe-column tfoot {
                background-color: #F9F9F9
            }

            .invoice_style11 .table-stripe-column .bg-inherit {
                background-color: inherit !important
            }

            .invoice_style11 .table-stripe-column th,.invoice_style11 .table-stripe-column td {
                padding: 13px 25px
            }

            .invoice_style11 .table-stripe-column th:first-child,.invoice_style11 .table-stripe-column td:first-child {
                width: 80px;
                padding: 13px
            }

            .invoice_style11 .table-stripe-column th:nth-last-child(-n+3),.invoice_style11 .table-stripe-column td:nth-last-child(-n+3) {
                width: unset
            }

            .invoice_style11 .table-stripe-column th:nth-child(2),.invoice_style11 .table-stripe-column td:nth-child(2) {
                width: 50%
            }

            .invoice_style12 {
                --border-color: #DADADA
            }

            .invoice_style12 .big-title {
                margin-bottom: 5px
            }

            .invoice_style12 .body-shape1 {
                top: 0
            }

            .invoice_style12 .table-stripe-column {
                --border-color: #DADADA;
                text-align: center;
                table-layout: fixed
            }

            .invoice_style12 .table-stripe-column tbody tr:last-child {
                border-bottom: 1px solid var(--border-color)
            }

            .invoice_style12 .table-stripe-column tbody,.invoice_style12 .table-stripe-column tfoot {
                background-color: #F9F9F9
            }

            .invoice_style12 .table-stripe-column .bg-inherit {
                background-color: inherit !important
            }

            .invoice_style12 .table-stripe-column th,.invoice_style12 .table-stripe-column td {
                padding: 13px 25px
            }

            .invoice_style12 .table-stripe-column th:first-child,.invoice_style12 .table-stripe-column td:first-child {
                width: 80px;
                padding: 13px
            }

            .invoice_style12 .table-stripe-column th:nth-last-child(-n+3),.invoice_style12 .table-stripe-column td:nth-last-child(-n+3) {
                width: unset
            }

            .invoice_style12 .table-stripe-column th:nth-child(2),.invoice_style12 .table-stripe-column td:nth-child(2) {
                width: 45%
            }

            .info-box3 {
                background-color: var(--theme-color);
                color: var(--white-color);
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
                padding: 18px 30px;
                -webkit-clip-path: polygon(0 0, calc(100% - 25px) 0%, 100% 100%, 0% 100%);
                clip-path: polygon(0 0, calc(100% - 25px) 0%, 100% 100%, 0% 100%)
            }

            .info-box3 b {
                color: var(--white-color);
                font-size: 16px;
                margin-right: 60px
            }

            .info-box3.style2 {
                text-align: right;
                -webkit-box-pack: end;
                -webkit-justify-content: flex-end;
                -ms-flex-pack: end;
                justify-content: flex-end;
                background-color: #031C33;
                -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 25px 100%);
                clip-path: polygon(0 0, 100% 0, 100% 100%, 25px 100%)
            }

            .table-stripe4.black-color th {
                background-color: #242437;
                background-image: none
            }

            [dir='rtl'] .invoice-buttons {
                -webkit-box-orient: horizontal;
                -webkit-box-direction: reverse;
                -webkit-flex-direction: row-reverse;
                -ms-flex-direction: row-reverse;
                flex-direction: row-reverse
            }

            [dir='rtl'] .invoice-buttons button svg {
                margin-left: 6px;
                margin-right: 0
            }

            [dir='rtl'] .header-layout12 .big-title {
                text-align: left;
                font-size: 40px
            }

            [dir='rtl'] .header-layout12 span {
                text-align: left
            }

            [dir='rtl'] .invoice-right {
                text-align: left
            }

            [dir='rtl'] .table-style9 th:last-child,[dir='rtl'] .table-style9 td:last-child {
                border-right: 1px solid var(--smoke-color);
                text-align: left
            }

            [dir='rtl'] .table-style9 tfoot th:not(:last-child),[dir='rtl'] .table-style9 tfoot td:not(:last-child) {
                padding-left: 0;
                text-align: left
            }

            [dir='rtl'] .total-table2 th:last-child,[dir='rtl'] .total-table2 td:last-child {
                text-align: left
            }

            .color_blue {
                --smoke-dark: #2D7CFE
            }

            .color_blue th {
                color: var(--white-color)
            }

            .template_shape1 {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                text-align: center
            }

            .body-shape9 img {
                height: 100%;
                width: 100%;
                object-fit: cover
            }

            .th-header.style_white h1,.th-header.style_white .h1,.th-header.style_white p,.th-header.style_white span,.th-header.style_white b {
                color: var(--white-color)
            }

            .th-header.style_white b {
                font-weight: 600
            }

            .th-header.style_white .svg-shape1 {
                left: 25px;
                width: calc(100% - 50px);
                -webkit-transform: translate(0, 0);
                -ms-transform: translate(0, 0);
                transform: translate(0, 0)
            }

            .th-header.style_white .svg-shape1 img {
                height: 100%;
                width: 100%
            }

            .dark_mode {
                --white-color: #111111;
                --title-color: #fff;
                --body-color: #E7E9ED;
                --smoke-color: #1A2733;
                --smoke-dark: #2D7CFE;
                --border-color: #1A2733
            }

            .dark_mode address,.dark_mode td {
                color: var(--body-color)
            }

            .dark_mode .address-box {
                background-color: var(--smoke-color);
                --border-color: #323D45
            }

            .dark_mode .print_btn {
                color: var(--theme-color)
            }

            .dark_mode .print_btn:hover {
                background-color: var(--smoke-color)
            }

            .dark_mode .download_btn {
                color: #fff
            }

            .dark_mode .download_btn:hover {
                background-color: var(--smoke-color)
            }

        </style>
    @endpush

    <div id="app">

        <meal-report-component
            :meal="{{ json_encode($meal) }}"
            :order-item-count="{{ $orderItemCount }}"
            :total-price-for-meal="{{ $totalPriceForMeal }}"
            :average-rating="{{ $averageRating }}"
        />

    </div>

@endsection
