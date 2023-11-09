<div>
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                @livewire('all-courts')
                <div class="col-lg-9">
                    @livewire('header-search-component')
                </div>
            </div>
        </div>
    </section>

    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    @livewire('hero-section', ['title' => 'Blog', 'pageName' => 'Blog'])
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__search">
                            <form action="#">
                                <input name="search" wire:model="search" type="text" placeholder="Search Posts">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>


                        <div class="blog__sidebar__item">
                            <h4>Categories</h4>
                            <ul>
                                <li><a href="#">All</a></li>
                                @foreach($categoryBlogs as $categoryBlog)
                                    <li><a href="#">{{$categoryBlog->name}} ({{$categoryBlog->posts->count()}})</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Filter By Category</h4>
                            <div class="blog__sidebar__item__tags">
                                <a wire:click="filterByCategory(null)" class="{{ !$selectedCategory ? 'active' : '' }}">All</a>
                                @foreach($categoryBlogs as $categoryBlog)
                                    <a wire:click="filterByCategory({{ $categoryBlog->id }})" class="{{ $selectedCategory == $categoryBlog->id ? 'active' : '' }}">{{ $categoryBlog->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img style="height: 400px" src="{{$post->image}}" alt="">
                                    </div>
                                    <div class="blog__item__text">
                                        <ul>
                                            <li><i class="fa fa-calendar-o"></i> {{ date('M d, Y', strtotime($post->created_at)) }}</li>
                                            <li><i class="fa fa-comment-o"></i> 0</li>
                                        </ul>
                                        <h5><a href="#">{{$post->title}}</a></h5>
                                        <p>{{$post->body}}</p>
                                        <a href="#" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-lg-12">
                            {{$posts->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
</div>
