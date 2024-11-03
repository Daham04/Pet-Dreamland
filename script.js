function changeView() {

    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");
}


function signUp() {

    
    var d = document.getElementById("d");
    var o = document.getElementById("o");
    var e = document.getElementById("e");
    var p = document.getElementById("p");
    var m = document.getElementById("m");
    var g = document.getElementById("g");

    var f = new FormData;
    f.append("o", o.value);
    f.append("d", d.value);
    f.append("e", e.value);
    f.append("p", p.value);
    f.append("m", m.value);
    f.append("g", g.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText
            if (t == "Success") {
                document.getElementById("msg").innerHTML = t;
                document.getElementById("msg").className = "bi bi-check2-circle fs-6";
                document.getElementById("alertdiv").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";
            } else {
                document.getElementById("msg").innerHTML = t;
                document.getElementById("msgdiv").className = "d-block";
                document.getElementById("alertdiv").className = "alert alert-danger";
            }

        }

    }


    r.open("POST", "signUpProcess.php", true);
    r.send(f);

}

function signIn() {
    var email = document.getElementById("emailsignin");
    var password = document.getElementById("passwordsignin");
    var rememberme = document.getElementById("remembermes");

    var f = new FormData();

    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                document.getElementById("msg").innerHTML = t;
                document.getElementById("msg").className = "bi bi-check2-circle fs-6";
                document.getElementById("alertdiv").className = "alert alert-success";
                document.getElementById("msgdiv").className = "d-block";
                window.location = "home.php";
            } else {
                document.getElementById("msg").innerHTML = t;
                document.getElementById("msgdiv").className = "d-block";
                document.getElementById("alertdiv").className = "alert alert-danger";
            }

        }
    }
    r.open("POST", "signInProcess.php", true);
    r.send(f);

}

function adminsignIn() {

    window.location = "adminSignIn.php";
}


var bm;

function forgotPassword() {

    var email = document.getElementById("emailsignin");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Verification code has sent your email. Please check your inbox");
                var m = document.getElementById("forgotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();


}

function ShowPassword() {

    var input = document.getElementById("npi");
    var eye = document.getElementById("e1");

    if (input.type == "password") {
        input.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        input.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function showPassword2() {
    var input = document.getElementById("rnp");
    var eye = document.getElementById("e2");

    if (input.type == "password") {
        input.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        input.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function resetpw() {

    var email = document.getElementById("emailsignin");
    var np = document.getElementById("npi");
    var rnp = document.getElementById("rnp");
    var vcode = document.getElementById("vc");

    var f = new FormData();
    f.append("e", email.value);
    f.append("n", np.value);
    f.append("r", rnp.value);
    f.append("v", vcode.value);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                bm.hide();
                alert("Password reset Success");
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "resetPassword.php", true);
    r.send(f);


}

const bar = document.getElementById("bar");
const nav = document.getElementById("navbar");
const close = document.getElementById("close");

if(bar){
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    })
}

if(close){
    close.addEventListener('click', () => {
        nav.classList.remove('active');
    })
}

function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (this.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {

                window.location = "signin.php";
            } else {
                alert(t);
            }

        }
    }
    r.open("GET", "signoutProcess.php", true);
    r.send();
}


function basicSearch(x) {

    var text = document.getElementById("basic_search_txt");
    var select = document.getElementById("basic_search_select");

    var f = new FormData();
    f.append("t", text.value);
    f.append("s", select.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }


    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);
}


function addToCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText
            alert(t);
        }
    }
    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();
}


function deleteFromCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Product removed from cart")
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "deleteFromCartProcess.php?id=" + id, true);
    r.send();
}


function addToWatchlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Removed") {
                document.getElementById("heart" + id).style.className = "text-dark";
                window.location.reload();
            } else if (t == "Added") {
                document.getElementById("heart" + id).style.className = "text-danger";
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "addtowatchlistprocess.php?id=" + id, true);
    r.send();
}

function removeFromWatchlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }
    r.open("GET", "removeWatchlistProcess.php?id=" + id, true);
    r.send();
}

function sort1(x) {


    var search = document.getElementById("s");
    var time = "0";;

    if (document.getElementById("n").checked) {
        time = "1";
    } else if (document.getElementById("o").checked) {
        time = "2";
    }

    var qty = "0";

    if (document.getElementById("h").checked) {
        qty = "1";
    } else if (document.getElementById("l").checked) {
        qty = "2";
    } else {

    }

    var condition = "0";

    if (document.getElementById("b").checked) {
        condition = "1";
    } else if (document.getElementById("u").checked) {
        condition = "2";
    }

    var r = new XMLHttpRequest();

    var f = new FormData();
    f.append("s", search.value);
    f.append("t", time);
    f.append("q", qty);
    f.append("c", condition);
    f.append("page", x);

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("sort").innerHTML = t;
        }
    }

    r.open("POST", "sortProcess.php", true);
    r.send(f);
}

function clearSort() {
    window.location.reload();
}

function changeStatus(id) {

    var product_id = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Deactivated") {

                alert("Product Deactivated");
                window.location.reload();

            } else if (t == "Activated") {

                alert("Product Activated");
                window.location.reload();

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "changeStatusProcess.php?p=" + product_id, true);
    r.send();
}


function sendId(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = this.responseText;

            if (t == "Success") {
                window.location = "updateProduct.php"
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "sendProductidProcess.php?id=" + id, true);
    r.send();
}

function changeProductImage() {

    var image = document.getElementById("imageuploader");

    image.onchange = function () {

        var file_count = image.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;
            }

        } else {
            alert("Please Select 3 or less than 3 images.")
        }
    }

}

function updateProduct() {

    var title = document.getElementById("t");
    var qty = document.getElementById("q");
    var delivery_within_colombo = document.getElementById("dwc");
    var delivery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("d");
    var images = document.getElementById("imageuploader");

    var r = new XMLHttpRequest();
    var f = new FormData();

    f.append("t", title.value);
    f.append("q", qty.value);
    f.append("dwc", delivery_within_colombo.value);
    f.append("doc", delivery_outof_colombo.value);
    f.append("d", description.value);

    var img_count = images.files.length;

    for (var x = 0; x < img_count; x++) {
        f.append("i" + x, images.files[x]);
    }

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("POST", "updateProcess.php", true);
    r.send(f);
}

function addProduct() {

    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");

    var condition = 0;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    }

    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var f = new FormData();

    f.append("ca", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("con", condition);
    f.append("qty", qty.value);
    f.append("cost", cost.value);
    f.append("dwc", dwc.value);
    f.append("doc", doc.value);
    f.append("desc", desc.value);


    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        f.append("image" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Product image saved sucessfully") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);



}

function changeImage() {
    var view = document.getElementById("viewImg");
    var file = document.getElementById("profileimg");

    file.onchange = function () {

        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;


    }


}


function districLoad(){

    var province1 = document.getElementById("province");
    var district = document.getElementById("district");

    var f = new FormData();
    f.append("p1", province1.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            // document.getElementById("district").innerHTML = t;
        }
    }

    r.open("POST", "updateDistric.php", true);
    r.send(f);
}

function updateProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var pcode = document.getElementById("pcode");
    var image = document.getElementById("profileimg");

    var f = new FormData();
    f.append("fn", fname.value);
    f.append("ln", lname.value);
    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("pc", pcode.value);

    if (image.files.length == 0) {
        var confirmation = confirm("Are you sure You don't want to update Profile Image?");

        if (confirmation) {
            alert("you have not slected any images");
        }

    } else {
        f.append("image", image.files[0]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);
}


function loadMainImg(id) {
    var img = document.getElementById("productImg" + id).src;
    var main = document.getElementById("main_img");
    main.style.backgroundImage = "url(" + img + ")";

}

function checkValue(qty) {
    var input = document.getElementById("qty_input");

    if (input.value <= 0) {
        alert("Quantity must be 1 or more");
        input.value = 1;
    } else if (input.value > qty) {
        alert("Maximum quantity achieved");
        input.value = qty;
    }
}

function qty_inc(qty) {
    var input = document.getElementById("qty_input");
    if (input.value < qty) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue.toString();
    } else {
        alert("Maximum quantity has achieved");
        input.value = qty;
    }
}

function qty_dec() {
    var input = document.getElementById("qty_input");
    if (input.value > 1) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue.toString();
    } else {
        alert("Minimum quantity has achieved");
        input.value = 1;
    }
}

function payNow(id) {

    var qty = document.getElementById("qty_input").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["mail"];
            var amount = obj["amount"];

            if (t == "1") {
                alert("Please Log in or Sign up");
                window.location = "index.php";
            } else if (t == "2") {
                alert("Please update Your Profile First");
                window.location = "userProfile.php";
            }else {

            
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {

                    saveInvoice(orderId, id, mail, amount, qty);
                    console.log("Payment completed. OrderID:" + orderId);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

             

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "",    // Replace your Merchant ID
                    "return_url": "http://localhost/petdreamland/singleProductView.php?id" + id,     // Important
                    "cancel_url": "http://localhost/petdreamland/singleProductView.php?id" + id,      // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash":obj["hash"],
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };
            }

        }
    }
    r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true)
    r.send();

}

function checkout(cart_num) {

    var qty = document.getElementById("qty_input").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var mail = obj["mail"];
            var amount = obj["amount"];

            if (t == "1") {
                alert("Please Log in or Sign up");
                window.location = "index.php";
            } else if (t == "2") {
                alert("Please update Your Profile First");
                window.location = "userProfile.php";
            }else {

            
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {

                    saveInvoice(orderId, cart_num, mail, amount, qty);
                    console.log("Payment completed. OrderID:" + orderId);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

             

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221047",    // Replace your Merchant ID
                    "return_url": "http://localhost/petdreamland/singleProductView.php?id" + id,     // Important
                    "cancel_url": "http://localhost/petdreamland/singleProductView.php?id" + id,      // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash":obj["hash"],
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": mail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };
            }

        }
    }
    r.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true)
    r.send();

}

function saveInvoice(orderId, id, mail, amount, qty) {

    var f = new FormData();

    f.append("o", orderId);
    f.append("i", id);
    f.append("m", mail);
    f.append("a", amount);
    f.append("q", qty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "saveInvoice.php", true);
    r.send(f);


  
}

var md;
function addFeedback(id) {

    var feed = document.getElementById("feedbackModal" + id);
    md = new bootstrap.Modal(feed);
    md.show();

}

function saveFeedback(id){

    var type;

    if(document.getElementById("type1").checked){
        type = 1;
    }else if(document.getElementById("type2").checked){
        type = 2;
    }else if(document.getElementById("type3").checked){
        type = 3;
    }

    var feedback = document.getElementById("feed");

    var f = new FormData();
    f.append("pid",id);
    f.append("t",type);
    f.append("f",feedback.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () { 
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "1"){
                md.hide();
            }else{
                alert (t);
            }
        }
     }

    r.open("POST","saveFeedbackProcess.php",true);
    r.send(f);

}

var av;
function adminVerification() {

    var email = document.getElementById("e");

    var f = new FormData();
    f.append("e", email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                var adminVerificationModal = document.getElementById("verificatioModal");
                av = new bootstrap.Modal(adminVerificationModal);
                av.show();
            } else {
                alert(t);

            }
        }
    }

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(f);
}

function verify() {
    var verification = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                av.hide();
                window.location = "adminpanel.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "verificationProcess.php?v=" + verification.value, true);
    r.send();

}

function blockUser(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Blocked") {
                document.getElementById("ub" + email).innerHTML = "Unblock";
                document.getElementById("ub" + email).classList = "btn btn-success";
            } else if (t == "Unblocked") {
                document.getElementById("ub" + email).innerHTML = "Block";
                document.getElementById("ub" + email).classList = "btn btn-danger";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "blockUserProcess.php?email=" + email, true);
    r.send();
}

function blockProduct(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Blocked") {
                document.getElementById("ub" + id).innerHTML = "Unblock";
                document.getElementById("ub" + id).classList = "btn btn-success";
            } else if (t == "Unblocked") {
                document.getElementById("ub" + id).innerHTML = "Block";
                document.getElementById("ub" + id).classList = "btn btn-danger";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "blockProductsProcess.php?id=" + id, true);
    r.send();
}

var pm;
function viewProductModal(id) {
    var m = document.getElementById("viewProductModal" + id);
    pm = new bootstrap.Modal(m);
    pm.show();
}

var cm;
function addNewCategory() {

    var m = document.getElementById("addCategoryModal");
    cm = new bootstrap.Modal(m);
    cm.show();
}

var vc;
var e;
var n;
function verifyCategory() {

    var ncm = document.getElementById("addCategoryVerificationModal");
    vc = new bootstrap.Modal(ncm);


    e = document.getElementById("e").value;
    n = document.getElementById("n").value;

    var f = new FormData();

    f.append("email", e);
    f.append("name", n);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                cm.hide();
                vc.show();
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "addNewCategoryProcess.php", true);
    r.send(f);

}

function saveCategory() {

    var txt = document.getElementById("txt").value;

    var f = new FormData();

    f.append("t", txt);
    f.append("e", e);
    f.append("n", n);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                vc.hide();
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "saveCategoryProcess.php", true);
    r.send(f);
}

function searchInvoiceId() {
    var txt = document.getElementById("searchtxt").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("viewArea").innerHTML = t;
        }
    }

    r.open("GET", "searchInvoiceIdProcess.php?id=" + txt, true);
    r.send();
}

function findSellings() {

    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("viewArea").innerHTML = t;
        }
    }

    r.open("GET", "findSellingsProcess.php?f=" + from + "&t=" + to, true);
    r.send();

}

function changeInvoiceStatus(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 1) {
                document.getElementById("btn" + id).innerHTML = "Packing";
                document.getElementById("btn" + id).classList = " btn btn-warning fw-bold mt-1 mb-1";
            } else if (t == 2) {
                document.getElementById("btn" + id).innerHTML = "Dispacth";
                document.getElementById("btn" + id).classList = "btn btn-info fw-bold mt-1 mb-1";
            }
            else if (t == 3) {
                document.getElementById("btn" + id).innerHTML = "Shipping";
                document.getElementById("btn" + id).classList = "btn btn-primary fw-bold mt-1 mb-1";
            }
            else if (t == 4) {
                document.getElementById("btn" + id).innerHTML = "Delivered";
                document.getElementById("btn" + id).classList = " btn btn-danger fw-bold mt-1 mb-1 disabled";
            } else {
                alert(t);
            }

        }
    }
    r.open("GET", "changeInvoiceStatusProcess.php?id=" + id, true);
    r.send();

}

function printInvoice() {
    var body = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = body;
}
