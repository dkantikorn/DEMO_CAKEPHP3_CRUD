<nav>
    <ul class="pagination pg-darkgrey">
        <?php echo $this->Paginator->first('<< ' . __('first')) ?>
        <?php echo $this->Paginator->prev('< ' . __('previous')) ?>
        <?php echo $this->Paginator->numbers() ?>
        <?php echo $this->Paginator->next(__('next') . ' >') ?>
        <?php echo $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?php echo $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
</nav>

<nav>
    <ul class="pagination pg-darkgrey">
        <!--Arrow left-->
        <li class="page-item">
            <a class="page-link waves-effect waves-effect" aria-label="Previous">
                <span aria-hidden="true">«</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>

        <!--Numbers-->
        <li class="page-item active"><a class="page-link waves-effect waves-effect">1</a></li>
        <li class="page-item"><a class="page-link waves-effect waves-effect">2</a></li>
        <li class="page-item"><a class="page-link waves-effect waves-effect">3</a></li>
        <li class="page-item"><a class="page-link waves-effect waves-effect">4</a></li>
        <li class="page-item"><a class="page-link waves-effect waves-effect">5</a></li>

        <!--Arrow right-->
        <li class="page-item">
            <a class="page-link waves-effect waves-effect" aria-label="Next">
                <span aria-hidden="true">»</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>