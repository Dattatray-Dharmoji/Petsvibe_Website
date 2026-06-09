<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/styles.css">
  <title>Pets Vibe</title>
</head>

<body>
  <header class="header">
    <nav class="nav">
      <div class="container nav_container">
        <div class="nav_left"></div>
        <a href="#" class="nav_logo">
          <img src="css/images/logo.png" alt="Logo">
        </a>
        <ul class="nav_list">
          <li class="nav_item"><a href="#" class="nav_link">Home</a></li>
          <li class="nav_item"><a href="#" class="nav_link">Category</a></li>
          <li class="nav_item"><a href="#" class="nav_link">About</a></li>
          <li class="nav_item"><a href="#" class="nav_link">Adopt</a></li>
        </ul>
        <div class="nav_right">
          <button id="loginRegisterBtn" class="btn_bg btn">Login/Register</button>
          <div id="profileContainer" style="display: none; align-items: center;">
            <span id="profileInitial" style="font-size: 18px; margin-left: 5px;"></span>
          </div>
        </div>
        
      </div>
    </nav>


     <!-- Modal for Login/Register -->
     <div id="modal" style="display: none;">
      <div id="modalContent">
          <span id="closeModal">&times;</span>
          <h2 id="modalTitle">Login</h2>
          <form id="authForm">
              <input type="email" id="email" placeholder="Email" required>
              <input type="password" id="password" placeholder="Password" required>
              <button type="submit">Login</button>
              <p>Don't have an account? <span id="toggleForm">Register</span></p>
              <a id="googleSignInBtn" class="google-signin" href="#">
                  <img src="./css/images/google.png" alt="Sign in with Google" style="width: 40px; height: auto;">
              </a>
          </form>
      </div>
  </div>
  <!-- Logout Confirmation Popup -->
<div id="logoutPopup" class="popup">
  <div class="popup-content">
      <span id="closePopup" class="close">&times;</span>
      <h2>Logged Out Successfully!</h2>
      <p>You have successfully logged out of your account.</p>
      <button id="closePopupBtn">Close</button>
  </div>
</div>


    <div class="container header_wrapper_container">
      <div class="header_wrapper">
        <h1 class="header_main_title">Your Pet Our Responsiblity !</h1>
        <p class="header_p">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto corporis quidem doloremque,
          error nostrum quae numquam.</p>
          <div class="header_btns">
            <a href="appointment.php" class="btn btn_outlined">Book Your Service</a>
            <a href="doctor.php" class="btn btn_bg">Adopt-ME</a>
          </div>
      </div>
    </div>

  </header>
  <!-- second section design start here -->
  <main>
    <section class="section">
      <div class="container">
          <div class="section_header">
              <div class="section_header_left">
                  <p class="section_header_p">What's New?</p>
                  <h2 class="section_header_h2">Take a Look at Some of Our Products</h2>
              </div>
              <div class="section_header_right">
                  <a href="manage_pets.php" class="btn btn_outlined">See More &rarr;</a>
              </div>
          </div>
          
          <div class="row">
              <?php
             include 'database.php';
              $query = "SELECT * FROM pets";
              $result = $conn->query($query);
  
              while ($row = $result->fetch_assoc()) {
                  echo "<div class='column'>
                          <div class='card'>
                              <img src='" . $row['image_path'] . "' alt='Pet Image'>
                              <h3 class='card_body_title'>" . $row['title'] . "</h3>
                              <div class='card_body_details'>
                                  <div class='card_body_details_gender'>Gender: " . $row['gender'] . "</div>
                                  <div class='card_body_details_age'>Age: " . $row['age'] . "</div>
                              </div>
<a href='billing.php?pet_id=" . $row['id'] . "&price=" . $row['price'] . "' class='card_body_price'>
    &#8377; " . number_format($row['price'], 2) . "
</a>

                          </div>
                        </div>";
              }
              $conn->close();
              ?>
          </div>
      </div>
      <!-- banner created -->
      <section class="section">
      <div class="container">
        <div class="banner">
         <div class="banner_wrapper">
          <img src="./css/images/model.png" alt="" class="banner_img">
          <div class="banner_content">
            <h1 class="banner_main_title">Your Pet Our Responsiblity !</h1>
        <p class="banner_p">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto corporis quidem doloremque,
          error nostrum quae numquam.</p>
          <div class="header_btns">
            <a href="" class="btn btn_outlined">Book Your Service</a>
            <a href="" class="btn btn_bg">Adopt-ME</a>
         </div>

          </div>
        </div>
      </div>
    </section>

  </section>
    <section class="section">
      <div class="container">
        <div class="section_header">
          <div class="section_header_left">
            <p class="section_header_p">NO Discount On Pets Grooming Products ?</p>
            <h2 class="section_header_h3">Our Products </h2>
          </div>
          
          <div class="section_header_righ">
        <a href="" class="btn btn_outlined">See More&rarr;</a>
          </div>
        </div>
        <div class="row">
          <div class="column">
            <div class="card">
            <img src="css/images/Frame 7 (1).png" alt="">
            <h3 class="card_body_title">NO 1 :Shrey Kadam</h3>
            <div class="card_body_details">
              <div class="card_body_details_gender">Gend:Male</div>
              <div class="card_body_details_age">Age:3mo</div>
            </div>
            <a href="#" class="card_body_price">&#8377; 3500</a>
            <div class="card_body_gift">
              <img src="./css/images/gift.png" alt="" class="card_body_gift_icon">
              <p class="card_body_gift_p">Free toy & Free Shaker</p>
            </div>
          </div>
        </div>
          <div class="column">
            <div class="card">
             <img src="css/images/Frame 7 (4).png" alt=""> 
             <h3 class="card_body_title">NO 1 :Shrey Kadam</h3>
             
             <div class="card_body_details">
              <div class="card_body_details_gender">Gend:Male</div>
              <div class="card_body_details_age">Age:3mo</div>
             </div>
             <a href="#" class="card_body_price">&#8377; 3500</a>
             <div class="card_body_gift">
              <img src="./css/images/gift.png" alt="" class="card_body_gift_icon">
              <p class="card_body_gift_p">Free toy & Free Shaker</p>
            </div>
          </div>
        </div>
          <div class="column">
            <div class="card">
        <img src="css/images/Frame 7 (3).png" alt="">
        <h3 class="card_body_title">NO 1 :Shrey Kadam</h3>
        
        <div class="card_body_details">
          <div class="card_body_details_gender">Gend:Male</div>
          <div class="card_body_details_age">Age:3mo</div>
        </div>
        <a href="#" class="card_body_price">&#8377; 3500</a>
        <div class="card_body_gift">
          <img src="./css/images/gift.png" alt="" class="card_body_gift_icon">
          <p class="card_body_gift_p">Free toy & Free Shaker</p>
        </div>
          </div>
        </div>
          <div class="column">
            <div class="card">
      <img src="css/images/Frame 7.png" alt="">
      <h3 class="card_body_title">NO 1 :Shrey Kadam</h3>
      
      <div class="card_body_details">
        <div class="card_body_details_gender">Gend:Male</div>
        <div class="card_body_details_age">Age:3mo</div>
      </div>
      <a href="#" class="card_body_price">&#8377; 3500</a>
      <div class="card_body_gift">
        <img src="./css/images/gift.png" alt="" class="card_body_gift_icon">
        <p class="card_body_gift_p">Free toy & Free Shaker</p>
      </div>
          </div>
        </div>
          <div class="column">
            <div class="card">
       <img src="css/images/Frame 7 (5).png" alt="">
       <h3 class="card_body_title">NO 1 :Shrey Kadam</h3>
       
       <div class="card_body_details">
        <div class="card_body_details_gender">Gend:Male</div>
        <div class="card_body_details_age">Age:3mo</div>
       </div>
       <a href="#" class="card_body_price">&#8377; 3500</a>
       <div class="card_body_gift">
        <img src="./css/images/gift.png" alt="" class="card_body_gift_icon">
        <p class="card_body_gift_p">Free toy & Free Shaker</p>
      </div>
          </div>
        </div>
          <div class="column">
            <div class="card">
        <img src="css/images/Frame 7 (4).png" alt="">
        <h3 class="card_body_title">NO 1 :Shrey Kadam</h3>
        
        <div class="card_body_details">
          <div class="card_body_details_gender">Gend:Male</div>
          <div class="card_body_details_age">Age:3mo</div>
        </div>
        <a href="#" class="card_body_price">&#8377; 3500</a>
        <div class="card_body_gift">
          <img src="./css/images/gift.png" alt="" class="card_body_gift_icon">
          <p class="card_body_gift_p">Free toy & Free Shaker</p>
        </div>
          </div>
        </div>
          <div class="column">
            <div class="card">
       <img src="css/images/Frame 7 (3).png" alt="">
       <h3 class="card_body_title">NO 1 :Shrey Kadam</h3>
       
       <div class="card_body_details">
        <div class="card_body_details_gender">Gend:Male</div>
        <div class="card_body_details_age">Age:3mo</div>
       </div><a href="#" class="card_body_price">&#8377; 3500</a>
       <div class="card_body_gift">
        <img src="./css/images/gift.png" alt="" class="card_body_gift_icon">
        <p class="card_body_gift_p">Free toy & Free Shaker</p>
      </div>
          </div>
        </div>
          <div class="column">
            <div class="card">
        <img src="css/images/Frame 7 (2).png" alt="">
        <h3 class="card_body_title">NO 1 :Shrey Kadam</h3>
        
        <div class="card_body_details">
          <div class="card_body_details_gender">Gend:Male</div>
          <div class="card_body_details_age">Age:3mo</div>
        </div>
        <a href="#" class="card_body_price">&#8377; 3500</a>
        <div class="card_body_gift">
          <img src="./css/images/gift.png" alt="" class="card_body_gift_icon">
          <p class="card_body_gift_p">Free toy & Free Shaker</p>
        </div>
          </div>
        </div>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="section_header">
          <div class="section_header_left">
            <p class="section_header_p">They Are With Us</p>
            <h2 class="section_header_h3">Top Brads</h2>
          </div>
       
  
        </div>
        <div class="logos_container">
          <img src="./css/images/Brand 2.png" alt="" class="brand_logo">
          <img src="./css/images/Brand 1.png" alt="" class="brand_logo">
          <img src="./css/images/Brand 3.png" alt="" class="brand_logo">
          <img src="./css/images/Brand 4.png" alt="" class="brand_logo">
          <img src="./css/images/Brand 5.png" alt="" class="brand_logo">
          <img src="./css/images/Brand 7.png" alt="" class="brand_logo">
          <img src="./css/images/Brand 6.png" alt="" class="brand_logo">
        </div> </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="banner2">
         <div class="banner_wrapper">
          <img src="./css/images/model.png" alt="" class="banner_img">
          <div class="banner_content">
            <h1 class="banner_main_title">Your Pet Our Responsiblity !</h1>
        <p class="banner_p">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto corporis quidem doloremque,
          error nostrum quae numquam.</p>
          <div class="header_btns">
            <a href="" class="btn btn_outlined">Book Your Service</a>
            <a href="" class="btn btn_bg">Adopt-ME</a>
         </div>

          </div>
        </div>
      </div>
    </section>
  </main>
  <script type="module" src="login.js"></script>
  <script type="module" src="firebaseConfig.js"></script>

</body>

</html>