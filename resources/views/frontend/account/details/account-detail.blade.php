@extends('frontend.master')
@section('title', 'Shop Acc CF, Mua Bán Nick Đột kích, Giá Rẻ Uy Tín, Bảo Hành Vĩnh Viễn')
@section('description', 'Shop acc cf, nơi mua bán acc Cf hay còn gọi là nick đột kích vtc, được đánh giá là uy tín như shop cf của Tiền Zombie v4, shop acc dot kich có 20k, 30k, 40k, 50k')
@section('keywords', 'mua nick cf, shop acc cf, mua acc cf, Shop acc cf, shop cf, shop tien zombie v4')
@section('main')

<div class="container">
    <div class="sl-dtprmain">
        <div class="sa-lsnmain clearfix">
            <ul class="sa-brea">
                <li>Trang Chủ</li>
                <li class="active"><a href="javascript:;">Thông tin chi tiết Acc CF #{{$data_account->acc_id}}</a>
                </li>
            </ul>
            <div class="row">
                <div class="col-sm-6">
                    <div class="sa-ttactit clearfix">
                        <h1 class="sa-ttacc-tit">
                            Acc CF #{{$data_account->acc_id}} </h1>
                    </div>
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-default hidden-sm hidden-md hidden-lg"
                        style="margin-bottom: 30px; border-radius: 0; font-size: 16px; font-weight: bold; padding: 20px; background: #FCAD26; border: none; color: #fff; font-family: Lato,'Helvetica Neue',Arial,Helvetica,sans-serif;"
                        onclick="showPopupAcc({{$data_account->acc_id}});">Mua Ngay Với Giá {{$data_account->price}}đ</button>
                    <div class="pull-right hidden-xs">
                        <button class="btn btn-default"
                            style="margin-bottom: 50px; border-radius: 0; font-size: 17px; font-weight: bold; padding: 20px; background: #FCAD26; border: none; color: #000; font-family: Lato,'Helvetica Neue',Arial,Helvetica,sans-serif;"
                            onclick="showPopupAcc({{$data_account->acc_id}});">Mua Tài Khoản Này Với Giá {{number_format($data_account->price)}}đ</button>
                    </div>
                </div>
            </div>
            <ul class="sa-ttacc-tabs clearfix">
                <li class="active"><a href="#tab-info" data-toggle="tab">THÔNG TIN</a></li>

                {{-- <li>
                    <a href="#tab-champ" data-toggle="tab">
                        DANH SÁCH TƯỚNG
                        <span>{{$data_account->count_champs}}</span>
                    </a>
                </li>
                <li>
                    <a href="#tab-skin" data-toggle="tab">
                        TRANG PHỤC
                        <span>{{$data_account->count_skins}}</span>
                    </a>
                </li>
                <li>
                    <a href="#tab-gem" data-toggle="tab">
                        NGỌC HỖ TRỢ
                        <span>{{$data_account->count_ngoc}}</span>
                    </a>
                </li> --}}
            </ul>
            <div class="sa-ttacc-tcont tab-content">
                <div class="tab-pane fade in active text-center" id="tab-info">
                    <div class="row">
                        <ul class="flex_wrap">
                            @foreach ($img_content as $imgSRC)
                                <li class="content_flex">
                                    <img src="{{$imgSRC}}" alt="shop acc cf uy tin gia re">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    </div> 
                </div>

                   <!-- Lightbox HTML -->
    <div class="lightbox-overlay" id="lightboxOverlay">
        <div class="lightbox-container" id="lightboxContainer">
            <div class="lightbox-loading" id="lightboxLoading">
                <i class="fas fa-spinner loading-spinner"></i>
            </div>
            
            <button class="lightbox-close" id="lightboxClose">
                <i class="fas fa-times"></i>
            </button>
            
            <div class="lightbox-header">
                <h3 class="lightbox-title" id="lightboxTitle">Shop acc CF uy tín giá rẻ</h3>
                <span class="lightbox-counter" id="lightboxCounter">1 / 6</span>
            </div>
            
            <img class="lightbox-image" id="lightboxImage" src="" alt="">
            
            <button class="lightbox-nav lightbox-prev" id="lightboxPrev">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <button class="lightbox-nav lightbox-next" id="lightboxNext">
                <i class="fas fa-chevron-right"></i>
            </button>
            
            <div class="lightbox-thumbnails" id="lightboxThumbnails">
                <!-- Thumbnails will be generated dynamically -->
            </div>
        </div>
    </div>
 <script>
        $(document).ready(function() {
            let currentImageIndex = 0;
            let images = [];
            
            // Initialize lightbox
            function initLightbox() {
                // Collect all images with data-lightbox attribute
                $('[data-lightbox="gallery"]').each(function(index) {
                    images.push({
                        src: $(this).attr('src'),
                        alt: $(this).attr('alt') || 'Image ' + (index + 1),
                        element: $(this)
                    });
                });
                
                // Generate thumbnails
                generateThumbnails();
                
                // Bind click events
                bindEvents();
            }
            
            // Generate thumbnail navigation
            function generateThumbnails() {
                const thumbnailContainer = $('#lightboxThumbnails');
                thumbnailContainer.empty();
                
                images.forEach(function(image, index) {
                    const thumb = $(`<img class="lightbox-thumb" src="${image.src}" alt="${image.alt}" data-index="${index}">`);
                    thumbnailContainer.append(thumb);
                });
            }
            
            // Bind all events
            function bindEvents() {
                // Image click to open lightbox
                $('[data-lightbox="gallery"]').on('click', function() {
                    const clickedIndex = images.findIndex(img => img.src === $(this).attr('src'));
                    if (clickedIndex !== -1) {
                        openLightbox(clickedIndex);
                    }
                });
                
                // Close lightbox
                $('#lightboxClose, #lightboxOverlay').on('click', function(e) {
                    if (e.target === this) {
                        closeLightbox();
                    }
                });
                
                // Navigation buttons
                $('#lightboxPrev').on('click', function() {
                    showPrevImage();
                });
                
                $('#lightboxNext').on('click', function() {
                    showNextImage();
                });
                
                // Thumbnail clicks
                $(document).on('click', '.lightbox-thumb', function() {
                    const index = parseInt($(this).attr('data-index'));
                    showImage(index);
                });
                
                // Keyboard navigation
                $(document).on('keydown', function(e) {
                    if ($('#lightboxOverlay').is(':visible')) {
                        switch(e.keyCode) {
                            case 27: // ESC
                                closeLightbox();
                                break;
                            case 37: // Left arrow
                                showPrevImage();
                                break;
                            case 39: // Right arrow
                                showNextImage();
                                break;
                        }
                    }
                });
            }
            
            // Open lightbox
            function openLightbox(index) {
                currentImageIndex = index;
                $('#lightboxOverlay').addClass('show').show();
                $('#lightboxContainer').addClass('show');
                $('body').css('overflow', 'hidden');
                showImage(index);
            }
            
            // Close lightbox
            function closeLightbox() {
                $('#lightboxOverlay').removeClass('show').addClass('hide');
                $('#lightboxContainer').removeClass('show');
                $('body').css('overflow', 'auto');
                
                setTimeout(function() {
                    $('#lightboxOverlay').removeClass('hide').hide();
                }, 300);
            }
            
            // Show specific image
            function showImage(index) {
                if (index < 0 || index >= images.length) return;
                
                currentImageIndex = index;
                const image = images[index];
                
                // Show loading
                $('#lightboxLoading').show();
                $('#lightboxImage').hide();
                
                // Load image
                const img = new Image();
                img.onload = function() {
                    $('#lightboxImage').attr('src', image.src).attr('alt', image.alt);
                    $('#lightboxTitle').text(image.alt);
                    $('#lightboxCounter').text(`${index + 1} / ${images.length}`);
                    
                    // Hide loading and show image
                    $('#lightboxLoading').hide();
                    $('#lightboxImage').show();
                    
                    // Update navigation buttons
                    updateNavigation();
                    
                    // Update thumbnails
                    updateThumbnails();
                };
                
                img.onerror = function() {
                    $('#lightboxLoading').hide();
                    $('#lightboxTitle').text('Lỗi tải ảnh');
                    $('#lightboxImage').show();
                };
                
                img.src = image.src;
            }
            
            // Update navigation buttons
            function updateNavigation() {
                $('#lightboxPrev').prop('disabled', currentImageIndex === 0);
                $('#lightboxNext').prop('disabled', currentImageIndex === images.length - 1);
            }
            
            // Update thumbnail active state
            function updateThumbnails() {
                $('.lightbox-thumb').removeClass('active');
                $(`.lightbox-thumb[data-index="${currentImageIndex}"]`).addClass('active');
            }
            
            // Show previous image
            function showPrevImage() {
                if (currentImageIndex > 0) {
                    showImage(currentImageIndex - 1);
                }
            }
            
            // Show next image
            function showNextImage() {
                if (currentImageIndex < images.length - 1) {
                    showImage(currentImageIndex + 1);
                }
            }
            
            // Initialize when document is ready
            initLightbox();
        });
    </script>

                <style>
                           /* Existing styles for image gallery */
        .flex_wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            padding: 0;
            margin: 0;
            list-style: none;
        }
        
        .content_flex {
            flex: 0 0 calc(33.333% - 10px);
            max-width: 200px;
        }
        
        .content_flex img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .content_flex img:hover {
            transform: scale(1.05);
            border-color: #FCAD26;
            box-shadow: 0 4px 15px rgba(252, 173, 38, 0.3);
        }
        
        /* Lightbox styles */
        .lightbox-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 9999;
            display: none;
            justify-content: center;
            align-items: center;
        }
        
        .lightbox-container {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        .lightbox-image {
            width: 100%;
            height: auto;
            max-height: 80vh;
            object-fit: contain;
            display: block;
        }
        
        .lightbox-header {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(180deg, rgba(0,0,0,0.8) 0%, transparent 100%);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
        }
        
        .lightbox-title {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }
        
        .lightbox-counter {
            font-size: 14px;
            opacity: 0.8;
        }
        
        .lightbox-close {
            position: absolute;
            top: 15px;
            right: 20px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            z-index: 11;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .lightbox-close:hover {
            background: rgba(255, 0, 0, 0.7);
            transform: scale(1.1);
        }
        
        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
        
        .lightbox-nav:hover {
            background: rgba(252, 173, 38, 0.8);
            transform: translateY(-50%) scale(1.1);
        }
        
        .lightbox-nav:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }
        
        .lightbox-nav:disabled:hover {
            background: rgba(0, 0, 0, 0.5);
            transform: translateY(-50%);
        }
        
        .lightbox-prev {
            left: 20px;
        }
        
        .lightbox-next {
            right: 20px;
        }
        
        .lightbox-thumbnails {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            background: rgba(0, 0, 0, 0.7);
            padding: 10px 15px;
            border-radius: 25px;
            max-width: 90%;
            overflow-x: auto;
        }
        
        .lightbox-thumb {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            opacity: 0.6;
        }
        
        .lightbox-thumb:hover,
        .lightbox-thumb.active {
            opacity: 1;
            border-color: #FCAD26;
            transform: scale(1.1);
        }
        
        /* Loading animation */
        .lightbox-loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 20px;
            z-index: 5;
        }
        
        .loading-spinner {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .lightbox-container {
                max-width: 95%;
                max-height: 95%;
            }
            
            .lightbox-nav {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
            
            .lightbox-prev {
                left: 10px;
            }
            
            .lightbox-next {
                right: 10px;
            }
            
            .lightbox-thumbnails {
                bottom: 10px;
                max-width: 95%;
            }
            
            .lightbox-thumb {
                width: 40px;
                height: 40px;
            }
            
            .content_flex {
                flex: 0 0 calc(50% - 7.5px);
            }
        }
        
        @media (max-width: 480px) {
            .content_flex {
                flex: 0 0 100%;
            }
        }
        
        /* Animation for lightbox */
        .lightbox-overlay.show {
            display: flex;
            animation: fadeIn 0.3s ease;
        }
        
        .lightbox-overlay.hide {
            animation: fadeOut 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
        
        .lightbox-container.show {
            animation: zoomIn 0.3s ease;
        }
        
        @keyframes zoomIn {
            from { 
                opacity: 0;
                transform: scale(0.8);
            }
            to { 
                opacity: 1;
                transform: scale(1);
            }
        }
                </style>
                </div>
            </div>
        </div>
    </div>
</div>

@stop