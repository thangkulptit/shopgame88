$(document).ready(function() {
    const type = $('#get-type-account').attr('data-type-filter') || '1';
    
    // Biến lưu trữ trạng thái tìm kiếm hiện tại
    let currentSearchData = {
        vip_level: '',
        price: '',
        sort: '',
        search_code: '',
        type: type
    };
    
    // Khôi phục trạng thái từ URL khi load trang
    restoreStateFromURL();
    
    // Xử lý sự kiện khi nhấn nút Tìm kiếm
    $('.btn-filter, .sl-sebt1').on('click', function(e) {
        e.preventDefault();
        
        // Lấy giá trị từ các select và input theo data-filter
        const vipLevel = $('select[data-filter="vip_level"]').val() || '';
        const priceRange = $('select[data-filter="price"]').val() || '';
        const sortFilter = $('select[data-filter="sort"]').val() || '';
        const searchCode = $('input[data-filter="tim-theo-trang-phuc"]').val().trim() || '';
        
        // Cập nhật trạng thái tìm kiếm hiện tại
        currentSearchData = {
            vip_level: vipLevel,
            price: priceRange,
            sort: sortFilter,
            search_code: searchCode,
            type: type
        };
        
        loadingAccount('show');
        fetch_data(currentSearchData, 1);
    });
    
    // Xử lý nút Reset/Hủy bỏ
    $('button[type="reset"], .sl-sebt2').on('click', function(e) {
        e.preventDefault();
        
        // Clear tất cả các select và input
        $('select[data-filter="vip_level"]').val('').trigger('change');
        $('select[data-filter="price"]').val('').trigger('change');
        $('select[data-filter="sort"]').val('').trigger('change');
        $('input[data-filter="tim-theo-trang-phuc"]').val('');
        
        // Reset trạng thái tìm kiếm
        currentSearchData = {
            vip_level: '',
            price: '',
            sort: '',
            search_code: '',
            type: type
        };
        
        // Tự động trigger tìm kiếm để load lại data mặc định
        loadingAccount('show');
        fetch_data(currentSearchData, 1);
    });
    
    // Xử lý sự kiện phân trang (hỗ trợ cả UI Semantic và Bootstrap)
    $(document).on('click', '.ui.pagination.menu a, .pagination a, [data-page]', function(event) {
        event.preventDefault();
        loadingAccount('show');
        
        let page = 1;
        
        // Lấy page từ href
        const href = $(this).attr('href');
        if (href) {
            const pageMatch = href.match(/page=(\d+)/);
            if (pageMatch) {
                page = pageMatch[1];
            }
        }
        
        // Hoặc lấy từ data-page attribute
        const dataPage = $(this).attr('data-page');
        if (dataPage) {
            page = dataPage;
        }
        
        fetch_data(currentSearchData, page);
    });
    
    // Hàm fetch data chung cho cả tìm kiếm và phân trang
    function fetch_data(searchData, page = 1) {
        // Chuẩn bị data để gửi
        const postData = {
            vip_level: searchData.vip_level,
            price: searchData.price,
            sort: searchData.sort,
            id: searchData.search_code, // Backend có thể expect field 'id'
            search_code: searchData.search_code,
            type: searchData.type
        };
        
        ajaxSetup();
        $.ajax({
            type: 'POST',
            url: "/account/load_account_list2?page=" + page,
            data: postData,
            success: function(responseData) {
                $('.display-account').html(responseData);
                loadingAccount('hide');
                
                // Cập nhật URL với trạng thái hiện tại
                updateURL(searchData, page);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                if (typeof toastr !== 'undefined') {
                    toastr.error('Có lỗi xảy ra khi tải dữ liệu');
                } else {
                    alert('Có lỗi xảy ra khi tải dữ liệu');
                }
                loadingAccount('hide');
            }
        });
    }
    
    // Hàm cập nhật URL với trạng thái hiện tại
    function updateURL(searchData, page) {
        const params = new URLSearchParams();
        
        // Thêm các tham số tìm kiếm vào URL
        if (searchData.vip_level) params.append('vip_level', searchData.vip_level);
        if (searchData.price) params.append('price', searchData.price);
        if (searchData.sort) params.append('sort', searchData.sort);
        if (searchData.search_code) params.append('search_code', searchData.search_code);
        if (searchData.type) params.append('type', searchData.type);
        if (page && page != 1) params.append('page', page);
        
        // Cập nhật URL mà không reload trang
        const newURL = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
        window.history.pushState({searchData: searchData, page: page}, '', newURL);
    }
    
    // Hàm khôi phục trạng thái từ URL
    function restoreStateFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        
        // Khôi phục giá trị tìm kiếm
        const vipLevel = urlParams.get('vip_level') || '';
        const price = urlParams.get('price') || '';
        const sort = urlParams.get('sort') || '';
        const searchCode = urlParams.get('search_code') || urlParams.get('id') || '';
        const page = urlParams.get('page') || 1;
        
        // Cập nhật UI với giá trị từ URL
        if (vipLevel) $('select[data-filter="vip_level"]').val(vipLevel);
        if (price) $('select[data-filter="price"]').val(price);
        if (sort) $('select[data-filter="sort"]').val(sort);
        if (searchCode) $('input[data-filter="tim-theo-trang-phuc"]').val(searchCode);
        
        // Cập nhật trạng thái tìm kiếm hiện tại
        currentSearchData = {
            vip_level: vipLevel,
            price: price,
            sort: sort,
            search_code: searchCode,
            type: type
        };
        
        // Nếu có tham số tìm kiếm trong URL, thực hiện tìm kiếm
        if (vipLevel || price || sort || searchCode) {
            loadingAccount('show');
            fetch_data(currentSearchData, page);
        }
    }
    
    // Xử lý sự kiện back/forward của browser
    window.addEventListener('popstate', function(event) {
        if (event.state && event.state.searchData) {
            currentSearchData = event.state.searchData;
            const page = event.state.page || 1;
            
            // Cập nhật UI
            $('select[data-filter="vip_level"]').val(currentSearchData.vip_level);
            $('select[data-filter="price"]').val(currentSearchData.price);
            $('select[data-filter="sort"]').val(currentSearchData.sort);
            $('input[data-filter="tim-theo-trang-phuc"]').val(currentSearchData.search_code);
            
            // Fetch data với trạng thái đã lưu
            loadingAccount('show');
            fetch_data(currentSearchData, page);
        } else {
            // Khôi phục từ URL nếu không có state
            restoreStateFromURL();
        }
    });
    
    // Xử lý sự kiện Enter trong ô input tìm kiếm
    $('input[data-filter="tim-theo-trang-phuc"]').on('keypress', function(e) {
        if (e.which === 13) { // Enter key
            e.preventDefault();
            $('.btn-filter').trigger('click');
        }
    });
    
    // Xử lý sự kiện thay đổi select (tùy chọn - để tự động tìm kiếm khi thay đổi)
    /*
    $('select[data-filter]').on('change', function() {
        // Uncomment dòng dưới nếu muốn tự động tìm kiếm khi thay đổi select
        // $('.btn-filter').trigger('click');
    });
    */
});