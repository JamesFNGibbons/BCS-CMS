<div class='col-md-9'>
    <div class='jumbotron'>
        <div class='container'>
            <h2>Contact Requets</h2>
            <p>Contact requests collected from the contact form.</p>
        </div>
    </div>
    <table class='table table-default'>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Website</th>
        <th></th>
        <?php foreach($requests as $request): ?>
            <tr>
                <td><?php print $request['Name']; ?></td>
                <td><?php print $request['Email']; ?></td>
                <td><?php print $request['Phone']; ?></td>
                <td><?php print $request['Website']; ?></td>
                <td>
                    <a class='text-danger' href='plugin-view.php?action_id=contact&delete=<?php print $request["ID"]; ?>'>
                        Delete Request
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php if(!count($requests)): ?>
        <h2 class='text-center'>No Requests Found.</h2>
    <?php endif; ?> 
</div>
