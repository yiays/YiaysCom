For the first time in many years, I lost quite a bit of work this year. I was reinstalling Linux on my server computer when I realized my SQL database backup routine was not working. Nearly every database I had made was lost. The biggest loss was Passport, my authentication service.

But more about that later. First, here's what I worked on this year!

### [Yiays.com](https://github.com/yiays/YiaysCom/commits?author=yiays&since=2022-12-31&until=2024-01-01)

![A screenshot of YiaysCom in light theme](https://cdn.yiays.com/blog/yiayscom-lighttheme.webp)

This year, Yiays.com saw plenty of optimization and code restructuring, but no major new features. After the database was lost, there was also quite a bit of damage control.

Probably the most visually stark changes this year are the removal of the old Yiays.com, and **light theme!** Dark theme is of course the default, but if your device specifically asks for light theme websites, my site will deliver.

> Several of my sites also got these new device theme-compliant icons, which don't disappear when your device is using light theme.

![A variety of website icons changing between light and dark theme](https://cdn.yiays.com/blog/dynamic-favicons.webp)

### [Smartboard Games](https://github.com/yiays/Smartboard-Games/commits?author=yiays&since=2023-06-30&until=2024-01-01)

The busiest project this year was definitely SmartBoard games, with over **50 commits** made to the project over the year. Two new games were added, and some major improvements were made to existing games (like fractions in Quick Division).

![The homepage for games.yiays.com with only the new games visible](https://cdn.yiays.com/blog/games-new-2023.webp)

Spelling Bee has the user hear spoken words and then try their best to spell them. While Flashcards mimics physical flashcards with 3d-rotating cards in the browser.

Adding fractions to the Quick Division game was challenging; fractions are not an easy concept for computers to work with, but the benefit is now rational numbers are much easier to read.

### [Discord JSON Dump Parser](https://github.com/yiays/Discord-JSON-Dump-Parser/commits?author=yiays&since=2023-11-30&until=2023-12-31)

My new Discord Dump Browser is the only notable new project created this year, it takes a chat history dump from a server and makes it browsable, and (in the future) searchable.

### What was lost with the SQL database

I'll summarize what was lost in order of importance.

#### Passport

The structure and data of Passport's database was lost. Making the project non-functional. I would need to reverse-engineer my own code to restore the project.

Passport was integrated into Yiays.com to authenticate authoring tools and (planned but not implemented) commenting. Without Passport working I've had to remove multi-user support and drastically simplify authentication.

#### Link Shortener

The structure and data of Link Shortener was lost. Meaning all links created no longer work. This project is very simple so if I am to bring the project back, I will do it from scratch.

#### Yiays.com

The blog was entirely lost. I had to scrape data from a snapshot of my website to bring it back online. Any hidden posts are lost. I'm now using a filesystem-based data storage system for the blog which means the blog posts and metadata are automatically backed up to GitHub whenever I make a commit. If the blog were to scale drastically, this would not be sustainable, but for now this works fine, if not better.

#### MemeDB

MemeDB is being rewritten in Next.js and the database had already been migrated to MongoDB, but as the rewrite isn't live yet, MemeDB was brought offline for many months as a result of the data loss. _I actually only just found a way to recover the old MemeDB on the day this post was written (January, 2024)!_

#### PukekoHost

PukekoHost's structure was open-sourced on GitHub, so I simply restored the structure without any data. As the project is still just a proof-of-concept and not a live service, there's no urgency to restore functionality.

…

Overall, the downtime of some of these projects has been detrimental on web traffic, but nothing precious or crucial was lost and recovery was interesting and challenging at times. This is a good mistake to learn from at this time.