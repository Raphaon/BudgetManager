@include("layouts/partials/_headInclude")
<body>


        <!-- Left Panel -->
        @include("layouts/partials/_navMenu")


        <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            @include('layouts/partials/_topInclude')
            @yield("athead")
        </header><!-- /header -->
        <!-- Header-->

        @include('layouts/partials/_titleMenu')

        <div class="content mt-3">

            @yield("content_block")

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
@include("layouts/partials/_scriptInclude")
@yield("atfoot")
</body>
</html>



