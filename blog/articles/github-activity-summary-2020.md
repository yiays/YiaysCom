2020 was the last year of my studies, but despite the increased pressure of my final year of work for my degree, personal projects continued to grow in terms of both complexity and popularity over this year.

### [PukekoHost](https://pukeko.yiays.com/)

![](https://cdn.yiays.com/blog/screenshot-pukeko.yiays.com-2021.11.15-14_33_59.webp)

I started this year (and the end of the holidays) strong with a lofty goal; to collaborate with another developer to build a game hosting startup from the ground-up. Naturally, this was way too big of an undertaking to realistically pull off, but I'm still impressed with how far we got.

PukekoHost is a game hosting service with an entirely novel financing system; any member of a Discord server can chip in any small amount of money towards uptime - as little as an hour minimum - and uptime is only spent when users _want_ the server online.

We got so far as setting up a [GitHub Team](https://github.com/Pukeko-Host/), designing and implementing a [MySQL Database](https://github.com/Pukeko-Host/PukekoDB) for storing state and transactions, implementing a [Web UI](https://github.com/Pukeko-Host/PukekoWebUI) to advertise services, allow users to pick products and pricing, and provide a dashboard where they can control and monitor their servers, and a [Rust Service](https://github.com/Pukeko-Host/GSMS) that would take requests to spin-up servers, manage files, and forward stdin and stdout to the dashboard.

As with a lot of massive projects, integration hell ensued once we got as far as we did. Progress has since slowed to a crawl, I still hold out hope that we manage to finish it one day.

### [MemeDB](https://meme.yiays.com/)

![](https://cdn.yiays.com/blog/screenshot-meme.yiays.com-2021.11.15-14_51_19.webp)

Moving on to the next massive project of this year, MemeDB is a database that attempts to organize memes into a massive database for searching and retrieval. Unlike PukekoHost, this project has been a resounding success; with the help of human input, [over 1000 memes are indeed searchable](https://meme.yiays.com/user/0/stats/) with the help of MemeDB. It's also became the best place for me to create a list of [favourited memes](https://meme.yiays.com/user/140297042709708800/favourites/) for sharing.

Like most of my projects, I'm once again using the LAMP stack to create a database, a web UI. I'm also using a discord bot to accept submissions for memes, and a CDN I've built to download, compress and serve any memes that end up on the website.

MemeDB is also one of the biggest undertakings in SEO I've had, and it's been a success in that regard too; MemeDB has the most visitors out of any site I've made, followed closely by this blog of course.

While the site is still fully functional right now, it's mostly unmaintained as I continue to slowly work away at a rewrite. I aim to move the entire database to MongoDB and rewrite the WebUI in NEXT.js - there has been some progress, but it's far from ready to launch.

### Merely

2020 was the year I polished up the pre-1.0 rewrite of Merely into a final release over the course of the year. By the end of 2020, Merely 0.x had MemeDB integration, Link Shortening, advanced slur detection and blocking, and per-server rules for said slur detection.

All of the above features never made it over to 1.0, so I think it was worthwhile to polish them up thoroughly before moving on for the sake of archival.

### [Merely Music](https://merely.yiays.com/music/)

For the end of my IT course, I had to come up with a big project, design, implement, and iterate over and over while keeping up with regular interviews with one of my tutors. I decided to address the concerns I, and many others had about the upcoming end of life of Google Play Music.

Google Play Music was a great service in it's time, providing cloud storage and sync of up to 10,000 songs and playlists and free offline play on your phone. For people that prefer to own their music rather than pay a subscription, it was fantastic and YouTube Music (the service that was about to replace Google Play Music) was an awful mess in comparison. The support for uploaded music was sub-par (even as of late 2021 there's still no way to edit metadata once you upload a song) and if you ever choose to listen to music you don't own, not being allowed to turn the screen off so you can be served video ads seems like more of an insult than not offering free music full stop.

I designed and built a MongoDB database to store and index music and an Expo Web/App to serve your music library. I also built [Passport](https://passport.yiays.com/), an OAuth-compliant login server for all of my projects. Passport decreases my reliance on identity providers like Discord and Google (meaning that people don't nessecarily lose their accounts on my sites if they lose their Discord / Google account). Passport also makes the experience between all of my apps more consistent - or, at least, it will one day. As of right now, Passport only works with my test builds of Merely Music and this blog, but the capability is there for it to take over the account systems of MemeDB and PukekoHost as well.

![](https://cdn.yiays.com/blog/screenshot-passport.yiays.com-2021.11.15-15_34_29.webp)

Merely Music (the app) ended up being the last component of many on my to-do list for this course and it's still in a very early stage of development. You can subscribe to the mailing list if you do want to know when it's ready for testing [here](https://merely.yiays.com/music/).

### ConfessionBot

2020 was also a big year for ConfessionBot, this bot (which was originally a commission only intended for one Discord server) blew up. I had to build out a support server and add translation support in a hurry to scale this bot up for wider use in the Discord community. Translation support was surely worth it, too, as 5 contributors have added a total of 5 languages to ConfessionBot's belt.