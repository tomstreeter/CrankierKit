# CrankierKit: Another riff on Kirby Plainkit

## Overview

This is a quirky and opinionated version of [Kirby Plainkit](https://GitHub.com/getkirby/plainkit.git). It's intended to be used on shared hosting plans that allow the user to load files _outside_ the public web root directory. It's configured to work on [Siteground](https://siteground.com) hosting out of the box, but can be easily adapted to other hosts. There are no symlinks; the only files in the public web root directory are those that absolutely have to be there. Everything else is safely outside the web server's gaze.

> _*Note*_: The Kirby documentation refers to what I call the _public web root directory_ simply as the _document root_. I use the longer phrase to emphasize a distinction between the directory you land in when you log in to whatever hosting service you use (e.g., your account's home directory) and the directory that contains the actual bits that are sent out by the web server (the _public web root directory_, or _document root_). If, when you log in to your hosting account using ssh or sftp, you can only see the contents of the public web root directory, use [the standard installation instructions](https://getkirby.com/docs/guide/quickstart#download-and-installation) because that's how Kirby will work best for you.

> If the previous paragraph makes no sense, do yourself a favor and just install Kirby as it says in [the standard installation instructions](https://getkirby.com/docs/guide/quickstart#download-and-installation).

The main reason this even exists is because it's a way for me to deploy a scaffold website that has all my boilerplate stuff already in it. For example, there are three plugins already installed:

1.  [Kirby3 Ray Helper](https://github.com/genxbe/kirby3-ray) by Sam Serrian for debugging with [Spatie Ray](https://spatie.be/products/ray). Will do nothing harmful if you don't use Ray.
1.  [Kirbylog](https://github.com/johannschopplich/kirbylog) by Johann Schopplick for logging tasks.
1.  [Types](https://github.com/lukaskleinschmidt/kirby-types) by Lukas Kleinschmidt as an IDE helper. This assumes Kirby [CLI](https://github.com/getkirby/cli) is already installed and working properly. The final step of the install process will fail if this isn't true.

This version supersedes an older one that relied on Git submodules for installing Kirby.

### So, About Kirby CMS ...

I'm a big fan of [Kirby CMS](https://getkirby.com). It's a great piece of software backed by a great little company and a community of loyal users. I have no connection with them except as a happily _paying_ customer. **_Kirby is not free software_**. If you're going to use it in a public environment, you **must** buy a license either directly from them or through a Kirby plugin author's website (same price, just helps support the Kirby ecoystem). You can find [everything you'd ever want to know](https://getkirby.com/license) about licensing Kirby on their website.

## Obligatory Disclaimer

This was made for my personal use and there are no guarantees it will work for you. There's a really good chance it won't. Its quirks are mine; you're welcome to your own. I'm making this freely available. I hope you find it useful. I'll answer questions that I can, but this is very definitely an "as-is" thing. I haven't used every hosting service under the sun and I don't plan to take it up as a hobby. I'm the _worst_ possible source of information about your hosting account. Your hosting provider is the best source of information.

## What this does and does not do

This is a quick way to spin up the scaffold of a website using Composer that's based on code from Kirby PlainKit. It's **_not_** PlainKit because it's certainly not plain anymore. There are asset directories, files, and snippets that don't exist in PlainKit, but all of that can be changed or discarded to be what you need it to be.

I use [CodeKit](https://codekitapp.com) to handle various build tasks. Thus, in my world, I install this project into a _Source_ folder then let CodeKit do its thing to render the entire site into a _Build_ folder. The web server I use for local developments uses the `public_html` directory in _Build_ as its document (or public web) root. I deploy from the _Build_ folder to the production server using _rsync_. Once the production site is active, I sync its _Content_ directory with the equivalent folder in my _Source_ folder, also using _rsync_. Codekit is set to propagate that synced content back to the local _Build_ directory so I have a local copy of the remote site for further local development. I also sync the production _Accounts_ directory with its equivalent in the _Build_ directory so the same users appear on both servers.

Seek medical attention if you adopt this workflow.

## Installation

1.  [Make sure you have Composer installed](https://getcomposer.org/download/).

1.  [Make sure you have Kirby CLI installed](https://github.com/getkirby/cli).

1.  Navigate to the location where you want to create the project directory.

1.  Enter on the command line:

    ```
    composer create-project crankybearmedia/crankierkit MyProject
    ```

    where

    ```
    MyProject
    ```

    is the name you want to give the project's directory.

1.  Do whatever you need to do to let your webserver know that

    ```
    /MyProject/public_html/
    ```

    is the public web root directory.

## Post-Install Details

1. The public web root directory is called `/public_html` on Siteground hosting. You may need to adjust this to match whatever convention your hossting provider uses.

1. Three configuration files are included in `/site/config`.
    - `config.php` allows the panel to be installed on a remote server.
    - `config.crankierkit.test.php` turns on debugging, but only for hosts that answers to the name `crankierkit.test` (spoiler alert, yours probably doesn't). Make it your own by changing the name to something that works on your development setup.
    - `config.PRODUCTION.com.php` needs its name changed to reflect your production environment.
    - `config.php` checks to see if an option named `standby` is `true` or `false.` If its value is `true`, the directory `/content/standby/` will be designated the site's home directory. If it's either not set or `false,` the `/content/home/` will be the home directory (as is the case regular PlainKit installations). This allows you to do things like set your production server to standby while still being able to push new content from the development server. When initially installed, `standby` is set to `true` on both the development and production server..
1. The `.htaccess` file is located in the public web root directory. It's the "stock" Kirby `.htaccess` file with the addition of the directive
   `
Header set Cache-Control "no cache, private"
	`
   to minimize the impact of Siteground's dynamic caching on Kirby license validation. See [this discussion](https://forum.getkirby.com/t/kirby-3-panel-not-updating-server-caching-or-license-key-issue/21444) for the gory details about why this is here.
1. `index.php` is located in `public_html` and is shown below.

1. The `/media` directory will be created in the public web root once the site is active. It can be deleted at any time and it will be regenerated as needed.

1. A `/storage` directory has been added as a sibling to `/content` and `/site` It contain the directories that the web server must have write permissions for: `/accounts`, `/cache`, `/sessions`, and `/logs`. The last is not a directory that's usually installed by Kirby, but is included to accommodate the `Kirbylog` plugin.

1. An `/assets` directory has been added to the public web root to hold CSS, JS, fonts, and graphics. A basic CSS scaffold is included. I'm a fan of Andy Bell's [CUBE CSS](https://cube.fyi/) methodology and my scaffold is more or less based on that.

1. The `default.php` template is modified to use a templating scheme I use. That scheme relies on `site/snippets/layout/` and `site/snippets/components/` to build pages.
