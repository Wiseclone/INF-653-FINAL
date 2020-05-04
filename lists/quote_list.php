<main>
    <nav>
        <form action="." method="get" id="author_selection">
            <section id="dropmenus">
                <?php if ( sizeof($authors) != 0) { ?>
                    
                    <label>Author:</label>
                    <select name="author">
                        <option value="0">View All Authors</option>
                        <?php foreach ($authors as $author) : ?>
                            <option value="<?php echo $author['id']; ?>">
                                <?php echo $author['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select> 
                <?php } ?>

                <?php if ( sizeof($categories) != 0) { ?>
                    <label>Category:</label>
                    <select name="category">
                        <option value="0">View All Categories</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['id']; ?>">
                                <?php echo $category['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select> 
                <?php } ?>
            </section>
        </form>
    </nav>
    <section>
        <?php if( sizeof($quotes) != 0 ) { ?>
            <div id="table-overflow">
                <table>
                    <thead>
                        <tr>
                            <th>Quote</th>
                            <th>Author</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($quotes as $quote) : ?>
                        <tr>
                            <td><?php echo $quote['text']; ?></td>
                            <td><?php echo $quote['author']; ?></td>
                            <td><?php echo $quote['category']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>  
        <?php } else { ?>
            <p>
                There are no matching quotes in our records. 
            </p>     
        <?php } ?>
    </section>
</main>