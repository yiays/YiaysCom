Despite a wealth of Discord bot developer drama, I spent a large chunk of this year building out a Discord bot framework. A common theme for almost all of my projects this year was _rewrites_.

## A retrospective on Discord bot drama

My first generalized programming language was Python 3. So, it naturally follows that my first Discord API Wrapper was Discord.py - a project headed solely by Danny.

When Danny announced his [departure from Discord.py in protest of some restrictive Discord API Changes](https://gist.github.com/Rapptz/4a2f62751b9600a31a0d3c78100287f1), I was surprised. I hadn't followed the situation very closely, so I had no idea this was a growing issue.

This might have been an unpopular take at the time, but I understood the need for this reform and the benefits it could bring. _Though it should be said even to this day (2024), I'm not impressed with what Discord provides in terms of alternatives to firehose access; there's still no practical way to ask a user to select a date or time!_

My bot ConfessionBot underwent a great deal of growth this year, and keeping up with the Discord API Firehose was impractical with one server. It was coming to a point where I might have to run two servers just to keep up with 10,000 Discord servers. The advent of Interactions and Slash Commands meant I didn't have to receive and process every single message from every server my bot has been added to.

No longer having to sanitize and validate every parameter of every user command was also a great relief. Type enforcement for command parameters along with command and parameter descriptions eventually made Discord bots great, although it took users years to figure out how to use them.

This period of change in the Discord space actually made me excited to rewrite all of my Discord bots and embrace these new features which made my bots much easier to write and maintain, so that's exactly what I did. In a fork of discord.py; first nextcord, then disnake.

## Merely Framework

This year, Merely was transformed from a simple Discord bot to the framework from which all of my bots could be built off of. The decision to do this was sparked by the growing annoyance that maintaining several independent Discord bots was starting to become apparent over the last few years.

Here are the tenets of the merely framework I built to make Discord bots easier.

### Cogs

Commands in the merely framework must be part of a Cog. Cogs are groups of commands that share state and dependencies. Cogs can be enabled, disabled, and reloaded as changes are made to the codebase, enabling continuous development of my Discord bots with as little interruption as is feasibly possible. Cogs are also each separated into their own file to keep code short.

### Data-driven design

Merelybot has removed any and all hardcoded strings, enabling an incredible amount of customization. Everything from the name of the bot to the changelog, to the commands listed in the help command are all controlled by a config file which can also be reloaded at any time.

### Community translation

Merelybot has a translation system named _Babel_. It's an improved rewrite of the translation system of the same name from ConfessionBot. Babel allows translators to translate all branches of conditional sentences in one go, read from the config file, and control the syntactical layout of a programmable sentence. I hope to eventually build a visual editor for translations to help less technical users help with translations in future too.

Merely (the Discord bot) is now an example implementation of the framework. This brings translation support, better error handling, custom prefixes, premium bot features, and an experimental command-less operation mode called lightbulb to merely and also makes maintenance much easier as the codebase is now shared with ConfessionBot.

## [WebFileManager](https://github.com/yiays/WebFileManager)

![](https://cdn.yiays.com/blog/webfilemanager.webp)

WebFileManager is a simple no-js file manager written in PHP. It's mostly a personal project built so I can share files online without having to deal with uploading files to the cloud (or having to pay to keep them there). It's especially useful for files that might be constantly changing, like a Minecraft world download.

There's not much for casual users to see of this project as this is a mostly private file server. If the source code makes any sense to you though, you're welcome to have a browse [here](https://github.com/yiays/WebFileManager). Curiously, the most fun I had with this project was actually designing all the iconography in Inkscape. I'm using PHP (icongen.php) to generate SVG file icons on the fly by enabling and disabling layers dynamically based on file metadata.

## Cookie Clicker

My simple cookie clicker clone got a lot of attention from one very dedicated user earlier this year. They started sending through bug reports and suggestions which I never expected would happen. I decided on a whim to entertain this and start improving this 5-year-old game once again and made a lot of progress over the span of one month. I wrote about the whole adventure [here](https://yiays.com/blog/the-curious-case-of-my-cookie-clicker-clone/).

## Yiays.com

As is basically tradition at this point, [Yiays.com](https://yiays.com/) witnessed another rewrite throughout the year. This time round I've tried to make a focused web design with straightforward navigation. Any user should be able to get to where they're going in 1 click - which you could not say about my 2020 design - Javascript is also completely optional (unless you want to author a blog post of course). If we're lucky, this year we can go without a rewrite, and I can instead bring back support for comments.

You can read more about the yearly redesigns of my portfolio website [here](https://yiays.com/blog/a-history-of-my-websites/).

## ConfessionBot 2.0

This rewrite has been in the works for a long time, partially because it's dependant on the Merely Framework, which was only finished this year. But it's almost here and it will bring a boatload of improvements; from improved translations to spam protections to premium features, 2.0 will mark the beginning of a transition towards a much easier to use bot. ~This will get its own blog post when it's ready.~ _Oops, I forgot._