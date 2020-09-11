<?php require_once "views/partials/header.php"; ?>
    <h1>Contact us</h1>
    <form action="/contact-submit" method="POST">
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" class="form-control">
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" id="message" class="form-control"></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>

<?php require_once "views/partials/footer.php"; ?>