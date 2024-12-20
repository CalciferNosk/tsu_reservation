<?php foreach ($result as $key => $value): ?>
  <!--Section: Newsfeed-->
  <section>
    <div class="card m-2" style="max-width: 45rem">
      <div class="card-body">
        <!-- Data -->
        <div class="d-flex mb-3">
          <a href="">
            <img src="<?= base_url() ?>assets/user_profile/<?= empty(_getUserProfile($value->PostCreatedby)) ? 'default_user.jpg' : _getUserProfile($value->PostCreatedby) ?>" class="border rounded-circle me-2"
              alt="Avatar" style="height: 40px" />
          </a>
          <div>
            <a href="" class="text-dark mb-0">
              <strong><?= _getUserFullName($value->PostCreatedby) ?></strong>
            </a>
            <a href="" class="text-muted d-block" style="margin-top: -6px">
              <small><?= _getHrAgo($value->CreatedDate) ?></small>
            </a>
          </div>
        </div>
        <!-- Description -->
        <div>
          <p>
            <?= $value->Description ?>
          </p>
          <?php if(!empty($value->EventId)): ?>
          Reservation <a target="_blank" href="<?= base_url() ?>view-event/<?= $value->EventId ?> ">event link here</a>
          <?php endif; ?>
        </div>
        <?php if(!empty($value->ContentImage)): ?>
        <div class="bg-image hover-overlay shadow-1-strong ripple rounded-5 mb-4" data-mdb-ripple-color="light">
          <center>
            <img src="<?= base_url() ?>assets/feed_images/<?= $value->ContentImage?>" class="img-fluid" />
          </center>

          <a href="#!">
            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
          </a>
        </div>
        <?php endif; ?>
      </div>
      <!-- Media -->
      <!-- <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
      <img src="https://mdbcdn.b-cdn.net/img/new/standard/people/077.webp" class="w-100" />
      <a href="#!">
        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
      </a>
    </div> -->
      <!-- Media -->
      <!-- Interactions -->
      <div class="card-body">
        <!-- Reactions -->
        <div class="d-flex justify-content-between mb-3">
          <div>
            <a href="">
              <i class="fas fa-thumbs-up text-primary"></i>
              <i class="fas fa-heart text-danger"></i>
              <span>124</span>
            </a>
          </div>
          <div>
            <a href="" class="text-muted"> 8 comments </a>
          </div>
        </div>
        <!-- Reactions -->

        <!-- Buttons -->
        <div class="d-flex justify-content-between text-center border-top border-bottom mb-4">
          <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-lg" data-mdb-ripple-color="dark">
            <i class="fas fa-thumbs-up me-2"></i>Like
          </button>
          <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-lg" data-mdb-ripple-color="dark">
            <i class="fas fa-comment-alt me-2"></i> <?php $value->CommentAction == 1 ? 'Comment' : '' ?>
          </button>
          <!-- <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-lg" data-mdb-ripple-color="dark">
          <i class="fas fa-share me-2"></i>Share
        </button> -->
        </div>
        <!-- Buttons -->

        <!-- Comments -->
        <?php if ($value->CommentAction == 1): ?>
          <!-- Input -->
          <div class="d-flex mb-3">
            <a href="">
              <img src="<?= base_url() ?>assets/user_profile/<?= _getUserProfile($_SESSION['username']) ?>" class="border rounded-circle me-2"
                alt="Avatar" style="height: 40px" />
            </a>
            <div data-mdb-input-init class="form-outline w-100">
              <textarea class="form-control" id="textAreaExample" rows="2"></textarea>
              <label class="form-label" for="textAreaExample">Write a comment</label>
            </div>
          </div>
          <!-- Input -->

          <!-- Answers -->

          <!-- Single answer -->
          <!-- <div class="d-flex mb-3">
        <a href="">
          <img src="https://mdbcdn.b-cdn.net/img/new/avatars/8.webp" class="border rounded-circle me-2"
            alt="Avatar" style="height: 40px" />
        </a>
        <div>
          <div class="bg-body-tertiary rounded-3 px-3 py-1">
            <a href="" class="text-dark mb-0">
              <strong>Malcolm Dosh</strong>
            </a>
            <a href="" class="text-muted d-block">
              <small>Lorem ipsum dolor sit amet consectetur,
                adipisicing elit. Natus, aspernatur!</small>
            </a>
          </div>
          <a href="" class="text-muted small ms-3 me-2"><strong>Like</strong></a>
          <a href="" class="text-muted small me-2"><strong>Reply</strong></a>
        </div>
      </div> -->

          <!-- Single answer -->
          <!-- <div class="d-flex mb-3">
        <a href="">
          <img src="https://mdbcdn.b-cdn.net/img/new/avatars/5.webp" class="border rounded-circle me-2"
            alt="Avatar" style="height: 40px" />
        </a>
        <div>
          <div class="bg-body-tertiary rounded-3 px-3 py-1">
            <a href="" class="text-dark mb-0">
              <strong>Rhia Wallis</strong>
            </a>
            <a href="" class="text-muted d-block">
              <small>Et tempora ad natus autem enim a distinctio
                quaerat asperiores necessitatibus commodi dolorum
                nam perferendis labore delectus, aliquid placeat
                quia nisi magnam.</small>
            </a>
          </div>
          <a href="" class="text-muted small ms-3 me-2"><strong>Like</strong></a>
          <a href="" class="text-muted small me-2"><strong>Reply</strong></a>
        </div>
      </div> -->

          <!-- Single answer -->
          <!-- <div class="d-flex mb-3">
        <a href="">
          <img src="https://mdbcdn.b-cdn.net/img/new/avatars/6.webp" class="border rounded-circle me-2"
            alt="Avatar" style="height: 40px" />
        </a>
        <div>
          <div class="bg-body-tertiary rounded-3 px-3 py-1">
            <a href="" class="text-dark mb-0">
              <strong>Marcie Mcgee</strong>
            </a>
            <a href="" class="text-muted d-block">
              <small>
                Officia asperiores autem sit rerum architecto a
                deserunt doloribus obcaecati, velit ab at, ad
                delectus sapiente! Voluptatibus quaerat suscipit
                in nostrum necessitatibus illum nemo quo beatae
                obcaecati quidem optio fugit ipsam distinctio,
                illo repellendus porro sequi alias perferendis ea
                soluta maiores nisi eligendi? Mollitia debitis
                quam ex, voluptates cupiditate magnam
                fugiat.</small>
            </a>
          </div>
          <a href="" class="text-muted small ms-3 me-2"><strong>Like</strong></a>
          <a href="" class="text-muted small me-2"><strong>Reply</strong></a>
        </div>
      </div> -->

          <!-- Single answer -->
          <!-- <div class="d-flex mb-3">
        <a href="">
          <img src="https://mdbcdn.b-cdn.net/img/new/avatars/10.webp" class="border rounded-circle me-2"
            alt="Avatar" style="height: 40px" />
        </a>
        <div>
          <div class="bg-body-tertiary rounded-3 px-3 py-1">
            <a href="" class="text-dark mb-0">
              <strong>Hollie James</strong>
            </a>
            <a href="" class="text-muted d-block">
              <small>Voluptatibus quaerat suscipit in nostrum
                necessitatibus</small>
            </a>
          </div>
          <a href="" class="text-muted small ms-3 me-2"><strong>Like</strong></a>
          <a href="" class="text-muted small me-2"><strong>Reply</strong></a>
        </div>
      </div> -->

          <!-- Answers -->
        <?php else: ?>
          <center><i style="color:#bab7b7">Comment Not Available for this Post</i></center>
        <?php endif; ?>
        <!-- Comments -->
      </div>
      <!-- Interactions -->
    </div>
  </section>
  <hr>
  <!--Section: Newsfeed-->
<?php endforeach; ?>