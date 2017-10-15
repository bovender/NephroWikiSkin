<?php
/**
 * Skin file for the NephroWikiSkin.
 *
 * @file
 * @ingroup Skins
 */
/**
 * SkinTemplate class for NephroWiki skin
 * @ingroup Skins
 */

 class SkinNephroWikiSkin extends SkinTemplate {
   var $skinname = 'nephrowikiskin', $stylename = 'NephroWikiSkin',
   $template = 'NephroWikiSkinTemplate', $useHeadElement = true;

   /**
   * This function adds JavaScript via ResourceLoader
   *
   * Use this function if your skin has a JS file or files.
   * Otherwise you won't need this function and you can safely delete it.
   *
   * @param OutputPage $out
   */

   public function initPage( OutputPage $out ) {
     parent::initPage( $out );
     $out->addModules( 'skins.nephrowikiskin.js' );
     $out->addHeadItem( 'responsive', '<meta name="viewport" content="width=device-width, initial-scale=1.0">' );
     $out->addHeadItem( 'responsive', <<<EOT
<!--[if lt IE 9]>
%script(src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"
  integrity="sha384-FFgGfda92tXC8nCNOxrCQ3R8x1TNkMFqDZVQdDaaJiiVbjkPBXIJBx0o7ETjy8Bh"
  crossorigin="anonymous")
%script(src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"
  integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo"
  crossorigin="anonymous")
<![endif]-->
EOT
    );
   }

   /**
   * Add CSS via ResourceLoader
   *
   * @param $out OutputPage
   */
   function setupSkinUserCss( OutputPage $out ) {
     parent::setupSkinUserCss( $out );
     $out->addModuleStyles( array(
       'mediawiki.skinning.interface', 'skins.nephrowikiskin'
     ) );
   }
 }


/**
 * BaseTemplate class for NephroWikiSkin
 *
 * @ingroup Skins
 */
 class NephroWikiSkinTemplate extends BaseTemplate {
   /**
   * Outputs the entire contents of the page
   */
   public function execute() {
     $this->html( 'headelement' ); ?>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#menu" aria-expanded="false">
        <span class="sr-only">Menü ein/aus</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="<?php echo htmlspecialchars( $this->data['nav_urls']['mainpage']['href'] ); ?>"
        <?php echo Xml::expandAttributes( Linker::tooltipAndAccesskeyAttribs( 'p-logo' ) ) ?>
        class="navbar-brand"
        >
        <?php $this->text( 'sitename' ); ?>
      </a>
    </div>
    <div class="collapse navbar-collapse" id="menu">
      <form class="navbar-form navbar-left" role="search" action="<?php $this->text( 'wgScript' ); ?>">
        <div class="form-group">
          <input type="hidden" name="title" value="<?php $this->text( 'searchtitle' ) ?>" />
          <?php echo $this->makeSearchInput( array( 'id' => 'searchInput', 'class' => 'form-control' ) ); ?>
        </div>
        <?php echo $this->makeSearchButton( 'go', array( 'id' => 'searchGoButton', 'class' => 'searchButton btn btn-default' ) ); ?>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <?php if ( isset( $this->data['content_actions']['edit'] ) ) { ?>
          <li>
            <?php
            $edit = $this->data['content_actions']['edit'];
            $editLabel = htmlspecialchars( $edit['text'] );
            ?>
            <a href="<?php echo htmlspecialchars( $edit['href'] ) ?>">
              <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="<?php echo $editLabel ?>" alt="<?php echo $editLabel ?>"></span>
              <span class="sr-only"><?php echo $editLabel ?></span>
            </a>
          </li>
        <?php } ?>
        <li class="dropdown">
          <a class="dropdown-toggle" href='#' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
            <span class="glyphicon glyphicon-cog" aria-hidden="true" title="<?php echo wfMessage( 'toolbox' )->text(); ?>"></span>
            <span class="sr-only"><?php echo wfMessage( 'toolbox' )->text(); ?></span>
            <ul class="dropdown-menu">
              <?php
              foreach ( $this->data['content_navigation'] as $category => $tabs ) {
                foreach ( $tabs as $key => $tab ) {
                  echo $this->makeListItem( $key, $tab );
                }
              }
              ?>
            </ul>
          </a>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" href='#' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
            <span class="glyphicon glyphicon-info-sign" aria-hidden="true" title="<?php echo wfMessage( 'toolbox' )->text(); ?>"></span>
            <span class="sr-only"><?php echo wfMessage( 'toolbox' )->text(); ?></span>
            <ul class="dropdown-menu">
              <?php
              foreach ( $this->getToolbox() as $key => $tbitem ) {
                echo $this->makeListItem( $key, $tbitem );
              }
              wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this ) );
              ?>
            </ul>
          </a>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" href='#' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
            <?php echo( $this->getPersonalTools()['userpage']['links'][0]['text'] ); ?>
            <ul class="dropdown-menu">
              <li role="presentation">
                <?php $this->myPersonalIconLink( 'preferences', 'cog' ); ?>
              </li>
              <li role="presentation">
                <?php $this->myPersonalIconLink( 'mytalk', 'user' ); ?>
              </li>
              <li role="presentation">
                <?php $this->myPersonalIconLink( 'watchlist', 'bookmark' ); ?>
              </li>
              <li role="presentation">
                <?php $this->myPersonalIconLink( 'mycontris', 'education' ); ?>
              </li>
              <li role="presentation"><?php $this->myPersonalLink( 'userpage', 'userpage' ); ?></li>
              <li role="separator" class="divider"></li>
              <li role="presentation">
                <?php $this->myPersonalIconLink( 'logout', 'off' ); ?>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php if ( $this->data['sitenotice'] ) { ?>
          <div id="siteNotice" class="alert alert-info">
            <?php $this->html( 'sitenotice' ); ?>
          </div>
        <?php } ?>
        <h1 class="page-header firstHeading">
          <?php $this->html( 'title' ); ?>
          <?php if ( $this->data['subtitle'] ) { ?>
            <small><?php $this->html( 'subtitle' ); ?></small>
          <?php } ?>
        </h1>
      </div>
    </div>

    <div class="row mw-body bodytext">
      <div class="col-md-12">
        <?php $this->html( 'bodytext' ) ?>
      </div>
    </div>
    <div class="row data-after-content">
      <div class="col-md-12">
        <?php $this->html( 'dataAfterContent' ); ?>
        <p><?php $this->html( 'catlinks' ); ?></p>
      </div>
    </div>

    <div class="row footer">
      <div class="col-md-12 text-center text-muted">
        <p style="margin:0">
          <small>
            <?php
            $first = true;
            foreach ( $this->getFooterLinks( 'flat' ) as $key ) {
              if (!$first) echo " ~ ";
              $this->html( $key );
              $first = false;
            } ?>
          </small>
        </p>
        <address>
          <small>
            <?php foreach ( $this->getFooterIcons( 'icononly' ) as $blockName => $footerIcons ) { ?>
              <?php
              foreach ( $footerIcons as $icon ) {
                echo $this->getSkin()->makeFooterIcon( $icon );
              }
              ?>
            <?php } ?>
          </small>
        </address>
      </div>
    </div>
  </div>

<?php $this->printTrail(); ?>
</body>
</html><?php
  }

  /// Helper function that echoes a link from the personal tools.
  private function myPersonalLink( $key, $msg = null ) {
    $link = $this->getPersonalTools()[$key]['links'][0];
    if ( $msg != null ) {
      $link['msg'] = $msg;
      unset( $link['text'] );
    }
    echo $this->makeLink( $key, $link );
  }

  /// Helper function that echoes a link with a glyphicon from the personal tools.
  private function myPersonalIconLink( $key, $icon ) {
    $link = $this->getPersonalTools()[$key]['links'][0];
    ?><a href="<?php echo( htmlspecialchars( $link['href'] ) ); ?>">
      <span class="glyphicon glyphicon-<?php echo( $icon ); ?>" aria-hidden="true"></span>
      <?php echo( htmlspecialchars( $link['text'] ) ); ?>
    </a><?php
  }
}
// vim: ts=2 noet sw=2
