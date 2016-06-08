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

	<body style="padding:18px;">
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
					>
						<img src="<?php $this->text( 'logopath' ); ?>" alt="<?php $this->text( 'sitename' ) ?>"
								 style="height:50px;width:auto;">
					</a>
					NephroWiki
				</div>
				<div class="collapse navbar-collapse" id="menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a class="dropdown-toggle" href='#' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
								Seitenwerkzeuge
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
						<li>
							<a class="dropdown-toggle" href='#' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
								Persönlich
							<ul class="dropdown-menu">
								<?php
									foreach ( $this->getPersonalTools() as $key => $item ) {
										echo $this->makeListItem( $key, $item );
									}
								?>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<form action="<?php $this->text( 'wgScript' ); ?>">
						<input type="hidden" name="title" value="<?php $this->text( 'searchtitle' ) ?>" />
						<?php
						echo $this->makeSearchInput( array( 'id' => 'searchInput' ) );
						echo $this->makeSearchButton( 'go', array( 'id' => 'searchGoButton', 'class' => 'searchButton' ) ); ?>
					</form>

					<ul>
					</ul>
					<ul>
					</ul>
					<h1 class="page-header">
						<?php $this->html( 'title' ); ?>
					</h1>
					<p><?php $this->html( 'catlinks' ); ?></p>
				</div>
			</div>

			<div class="row bodytext">
				<div class="col-md-12">
					<?php $this->html( 'bodytext' ) ?>
				</div>
			</div>
			<div class="row data-after-content">
				<div class="col-md-12">
					<?php $this->html( 'dataAfterContent' ); ?>
				</div>
			</div>

			<div class="row" style="margin-top: 18px">
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
}
// vim: ts=2 noet sw=2
