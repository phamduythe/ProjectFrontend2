getAllProducts();

const productDetail = document.querySelector('.product-detail');
const productList = document.querySelector('.product-list');

async function getAllProducts() {
    const url = 'getallproducts.php';
    const loader = document.querySelector('.loader');

    loader.style.display = 'unset';
    //b1: gui yeu cau
    const response = await fetch(url);

    //b2: xu ly ket qua
    const result = await response.json();
    result.forEach(element => {
        const product = `
            <div class="row">
                <div class="col-md-2">
                    <img src="public/images/${element.product_image}" alt="" class="img-fluid product-photo" data-product-id="${element.product_id}">
                </div>
                <div class="col-md-10">
                    <h4 class"name"><a href="product.php?id=${element.product_id} ">${element.product_name}</a></h4>
                    <p>${element.product_price}</p>
                </div>
            </div>
        `;
        productList.innerHTML += product;
    });
    
    loader.style.display = 'none';

    const productPhotos = document.querySelectorAll('.product-photo');
    productPhotos.forEach(element => {
        element.addEventListener('click', function () {
            getProductDetail(element.dataset.productId);
        });
    });
}


async function getProductDetail(productId) {
    const url = 'getproductdetail.php';
    const data = { productId: productId };
    const loader = document.querySelector('.loader');

    loader.style.display = 'unset';
    // Buoc 1: Gui request
    const response = await fetch(url, {
        method  : 'POST',
        headers : {
            'Content-Type'  : 'application/json',
            'Accept'        : 'application/json'
        },
        body    : JSON.stringify(data)
    });

    // Buoc 2: Xu ly ket qua
    const result = await response.json();
    productDetail.innerHTML = `
        <h2>${result.product_name}</h2>
    `;

    loader.style.display = 'none';
}

// Suggest Search
const inputKeyword = document.querySelector('#input-keyword');
const searchItem = document.querySelector('.search-item');

inputKeyword.addEventListener('input', function () {
    searchProducts(this.value);
});

async function searchProducts(keyword) {
    const url = 'searchproducts.php';
    const data = { keyword: keyword };
    const loader = document.querySelector('.loader');

    loader.style.display = 'unset';
    // Buoc 1: Gui request
    const response = await fetch(url, {
        method  : 'POST',
        headers : {
            'Content-Type'  : 'application/json',
            'Accept'        : 'application/json'
        },
        body    : JSON.stringify(data)
    });

    // Buoc 2: Xu ly ket qua
    const result = await response.json();
    searchItem.innerHTML = '';
    result.forEach(element => {
        /*
        const regex = new RegExp(keyword, 'gi');
        let text = element.product_name;
        text = text.replace(/(<mark class="highlight">|<\/mark>)/gim, '');
        const newText = text.replace(regex, '<mark class="highlight">$&</mark>');
        searchItem.innerHTML += `
            <a href="#" class="list-group-item list-group-item-action">${newText}</a>
        `; 
        */
        let item = document.createElement('a');
        item.textContent = element.product_name;
        item.className = 'list-group-item list-group-item-action';

        var markInstance = new Mark(item);
        markInstance.unmark({
            done: function(){
              markInstance.mark(keyword);
          }
        });

        searchItem.appendChild(item);
    });

    loader.style.display = 'none';   
}

// Filter category
const categoriesCheckbox = document.querySelectorAll('input[name=categoryId]');

categoriesCheckbox.forEach(element => {
    element.addEventListener('change', function () {
        const checkedInput = document.querySelectorAll('input[name=categoryId]:checked');
        // cach 2
        const checkedCategory = [...checkedInput].map(element => element.value);

        // console.log(checkedCategory);

        getProductbyCategories(checkedCategory);
    })
});

async function getProductbyCategories(arrCategoryId) {
    const url = 'getproductbycategories.php';
    const data = { categoryId: arrCategoryId };
    const loader = document.querySelector('.loader');

    loader.style.display = 'unset';
    productList.innerHTML = "";
    // Buoc 1: Gui request
    const response = await fetch(url, {
        method  : 'POST',
        headers : {
            'Content-Type'  : 'application/json',
            'Accept'        : 'application/json'
        },
        body    : JSON.stringify(data)
    });

    // Buoc 2: Xu ly ket qua
    const result = await response.json();
    result.forEach(element => {
        const product = `
            <div class="row">
                <div class="col-md-2">
                    <img src="public/images/${element.product_image}" alt="" class="img-fluid product-photo" data-product-id="${element.product_id}">
                </div>
                <div class="col-md-10">
                    <h4><a href="product.php/${element.product_id}">${element.product_name}</a></h4>
                    <p>${element.product_price}</p>
                </div>
            </div>
        `;
        productList.innerHTML += product;
    });
    
    loader.style.display = 'none';

}