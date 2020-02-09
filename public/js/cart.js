var grabedurl = window.location.pathname;
var url = "/api" + grabedurl;

$.ajax({
    url: '/getdatacart',
    method: "GET",
    datatype: "json",
    success: function(get) {
        $("#subtotal").append(
            `
            ${get}
            `
        );
        $("#subtotal2").append(
            `
            ${get}
            `
        )
    }
});

// var no = 0;
// $.ajax({
//     url: '/getdatacart',
//     method: "GET",
//     datatype: "json",
//     success: function(berhasil) {
//         $.each(berhasil.data.carts, function(key, value) {
//             no++;
//             $("#listcart").append(
//                 `
//                 <input type="hidden" name="id_produk[]" value="${value.id_produk}">
//                 <tr>
//                     <td class="cart_product_img">
//                         <a href="#"><img src="assets/poto/${value.foto_produk}" alt="Product" style="width:200px; height:200px"></a>
//                     </td>
//                     <td class="cart_product_desc">
//                         <h5>${value.nama_produk}</h5>
//                     </td>
//                     <td class="price">
//                         <span>${value.harga_produk}</span>
//                     </td>
//                     <td class="qty">
//                         <div class="qty-btn d-flex">
//                             <p>Qty</p>
//                             <div class="quantity">
//                                 <span class="qty-minus" onclick="var effect = document.getElementById('qty` + no + `'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
//                                 <input type="number" class="qty-text" id="qty` + no + `" step="1" min="1" max="300" name="qty[]" value="{{ $data['qty'] }}">
//                                 <span class="qty-plus" onclick="var effect = document.getElementById('qty` + no + `'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
//                             </div>
//                         </div>
//                     </td>
//                 </tr>
//             `
//             );
//         })
//     }
// });