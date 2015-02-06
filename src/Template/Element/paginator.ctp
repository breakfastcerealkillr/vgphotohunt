<div class="row">
    <div class="col-md-8 col-centered">
        <div class="pagination">
            <?php
            echo $this->Paginator->prev(' << ' . __('previous'));
            echo $this->Paginator->numbers();
            echo $this->Paginator->next(__('next') . ' >> ');
            ?>
        </div>
    </div>
</div>