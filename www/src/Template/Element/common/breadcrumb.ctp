<!--<div style="height: 40px"></div>-->
<div class="container">
    <section class="section text-center">
        <?php

        use Cake\Utility\Inflector;

//            $this->Html->templates(['icon' => '<i class="fa fa-{{type}}{{attrs.class}}"{{attrs}}></i>']);
//            $this->Html->addCrumb('Home', '/');
//            $this->Html->addCrumb('Pages', ['controller' => 'pages']);
//            $this->Html->addCrumb('About', ['controller' => 'pages', 'action' => 'about']);
//            echo $this->Html->getCrumbList(['class'=>'br-item']);
        $this->Breadcrumbs->templates([
            'wrapper' => '<nav class="breadcrumbs"><ol{{attrs}}>{{content}}</ol></nav>',
            'item' => '<li{{attrs}} class="breadcrumb-item"><a href="{{url}}"{{innerAttrs}}>{{title}}</a></li>{{separator}}',
            'itemWithoutLink' => '<li{{attrs}} class="breadcrumb-item active">{{innerAttrs}}{{title}}</li>{{separator}}',
        ]);

        $this->Breadcrumbs->add([
            ['title' => __('Home'), 'url' => ['controller' => 'Home', 'action' => 'index']],
            ['title' => __(Inflector::humanize(Inflector::underscore($this->request->controller))), 'url' => ['controller' => $this->request->controller, 'action' => 'index']],
            ['title' => __(Inflector::humanize(Inflector::underscore($this->request->action)))]
        ]);

        echo $this->Breadcrumbs->render(['class' => 'breadcrumb']);
        ?>
    </section>
</div>
