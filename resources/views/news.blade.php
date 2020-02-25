                <!-- Section Title -->
                <div class="section-heading">
                    <h5>News</h5>
                </div>
                <div class="most-viewed-videos-slide owl-carousel">
                    @foreach($news as $newNews)
                        <!-- Single Blog Post -->
                        <div class="single-blog-post style-4">
                            <div class="post-thumbnail">
                                <img src="/public_files/image/news/{{ (is_null($newNews->cover_photos))? 'default-cover.jpg' : $newNews->cover_photos }}" alt="">
                                {{-- <a href="video-post.html" class="video-play"><i class="fa fa-play"></i></a> --}}
{{--                                 <span class="video-duration">09:27</span> --}}
                            </div>
                            <div class="post-content">
                                <a href="{{ route('news.details', $newNews->id) }}" class="post-title">{{ $newNews->title }}</a>
                                <div class="post-meta d-flex">
                                    <a href="#">By: {{ $newNews->author }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
