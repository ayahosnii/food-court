@push('styles')
    <style>
        .rd-reviews {
            padding-top: 55px;
            border-top: 1px solid #e5e5e5;
            margin-bottom: 50px;
        }
        .rd-reviews h4 {
            color: #19191a;
            letter-spacing: 1px;
            margin-bottom: 45px;
        }
        .rd-reviews .review-item {
            margin-bottom: 32px;
        }
        .rd-reviews .review-item .ri-pic {
            float: left;
            margin-right: 30px;
        }
        .rd-reviews .review-item .ri-pic img {
            height: 70px;
            width: 70px;
            border-radius: 50%;
        }
        .rd-reviews .review-item .ri-text {
            overflow: hidden;
            position: relative;
            padding-left: 30px;
        }
        .rd-reviews .review-item .ri-text:before {
            position: absolute;
            left: 0;
            top: 0;
            width: 1px;
            height: 100%;
            background: #e9e9e9;
            content: "";
        }
        .rd-reviews .review-item .ri-text span {
            font-size: 12px;
            color: #dfa974;
            text-transform: uppercase;
            letter-spacing: 3px;
        }
        .rd-reviews .review-item .ri-text .rating {
            position: absolute;
            right: 0;
            top: 0;
        }
        .rd-reviews .review-item .ri-text .rating i {
            color: #f5b917;
        }
        .rd-reviews .review-item .ri-text h5 {
            color: #19191a;
            margin-top: 4px;
            margin-bottom: 8px;
        }
        .rd-reviews .review-item .ri-text p {
            color: #707079;
            margin-bottom: 0;
        }
        .review-add h4 {
            color: #19191a;
            letter-spacing: 1px;
            margin-bottom: 45px;
        }
        .review-add .ra-form input {
            width: 100%;
            height: 50px;
            border: 1px solid #e5e5e5;
            font-size: 16px;
            color: #aaaab3;
            padding-left: 20px;
            margin-bottom: 25px;
        }
        .review-add .ra-form input::-webkit-input-placeholder {
            color: #aaaab3;
        }
        .review-add .ra-form input::-moz-placeholder {
            color: #aaaab3;
        }
        .review-add .ra-form input:-ms-input-placeholder {
            color: #aaaab3;
        }
        .review-add .ra-form input::-ms-input-placeholder {
            color: #aaaab3;
        }
        .review-add .ra-form input::placeholder {
            color: #aaaab3;
        }
        .review-add .ra-form h5 {
            font-size: 20px;
            color: #19191a;
            margin-bottom: 24px;
            float: left;
            margin-right: 10px;
        }
        .review-add .ra-form .rating {
            padding-top: 3px;
            display: inline-block;
        }
        .review-add .ra-form .rating i {
            color: #f5b917;
            font-size: 16px;
        }
        .review-add .ra-form textarea {
            width: 100%;
            height: 132px;
            border: 1px solid #e5e5e5;
            font-size: 16px;
            color: #aaaab3;
            padding-left: 20px;
            padding-top: 12px;
            margin-bottom: 24px;
            resize: none;
        }
        .review-add .ra-form textarea::-webkit-input-placeholder {
            color: #aaaab3;
        }
        .review-add .ra-form textarea::-moz-placeholder {
            color: #aaaab3;
        }
        .review-add .ra-form textarea:-ms-input-placeholder {
            color: #aaaab3;
        }
        .review-add .ra-form textarea::-ms-input-placeholder {
            color: #aaaab3;
        }
        .review-add .ra-form textarea::placeholder {
            color: #aaaab3;
        }
        .review-add .ra-form button {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            color: #ffffff;
            letter-spacing: 2px;
            background: #dfa974;
            border: none;
            padding: 14px 34px 13px;
            display: inline-block;
        }
    </style>
@endpush
<div class="tab-pane" id="tabs-2" role="tabpanel">
    <div class="rd-reviews">
        <h4>Reviews</h4>
        @foreach($ratings as $rating)
            <div class="review-item">
                <div class="ri-pic">
                    <img src="img/room/avatar/avatar-1.jpg" alt="">
                </div>
                <div class="ri-text">
                    <span>27 Aug 2019</span>
                    <div class="rating">
                        {{$rating->rating}}
                        @for($i = 0; $i < $rating->rating; $i++)
                                <i class="icon_star"></i>
                        @endfor
                    </div>
                    <h5>{{$rating->user->name}}</h5>
                    <p>{{$rating->comment}}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
