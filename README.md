Bootstrap-based MediaWiki skin "NephroWikiSkin"
===============================================

This is a [Bootstrap][1]-based [MediaWiki][2] skin that was primarily developed 
for the private [NephroWiki][3] wiki, but can be adapted to other wikis easily.


## Installation

- Clone the repository into `skins/`. The master branch of this repository 
  will always be stable.
- [Bootstrap][1] was added as a submodule, which is not automatically included 
  when cloning this respository. Switch to `resources/bootstrap` and issue `git 
  pull` to fetch the [Bootstrap repository][4]. Alternatively, you can download 
  Bootstrap in a compressed file and extract it into `resources/bootstrap`.
- Add `wfLoadSkin( 'NephroWikiSkin' );` to your `LocalSettings.php`.


## Bootstrap customization

This skin uses [LESS][5] to build the style sheets.

Bootstrap variables are overridden in 
[nephrowiki.less](resources/css/nephrowiki.less). This is also the one LESS 
file that includes all other files.


## License

This MediaWiki skin is available for use under the [MIT license](COPYING).

Please note that this license is not compatible with MediaWiki's GPL-2.0+ 
license, i.e. you cannot redistribute this skin together with MediaWiki. You 
can however use this skin for your own MediaWiki installations.


[1]: http://getbootstrap.com
[2]: http://mediawiki.org
[3]: https://nephrowiki.de
[4]: https://github.com/twbs/bootstrap
[5]: http://lesscss.org
