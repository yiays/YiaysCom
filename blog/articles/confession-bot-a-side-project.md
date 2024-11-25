ConfessionBot is the most advanced anonymous messaging bot on Discord, with mod tools, multiple anonymous channel types, image support, and much more!

### Features

*   Multiple channels support, each channel can have its own configuration
*   Secure ID obfuscation or complete anonymity available
*   Vetting, prevent messages from being posted publicly without approval from a moderator
*   Option to hide anon-ids in public channels but show in vetting channels
*   Image support
*   Reply support using the right click / long press menu
*   Users can be blocked from sending anonymous messages
*   ConfessionBot can automatically use your language in user settings or the server language in server settings
*   Users can trust ConfessionBot as admins are not given free rein to expose users

#### Premium features

ConfessionBot premium can be obtained by boosting the [official server](https://discord.gg/wfKx24kDUR), contributing translations, or by supporting Yiays on [Patreon](https://patreon.com/yiays).

> Premium features are intended for admins of a server. Perks affect all members of your server.

*   **Compact mode:** Anonymous messages can appear to come from their own user accounts, with their Anon-ID as the username, and their colour as the profile picture.
*   **Confession branding:** Add a mention, or decoration before all anonymous messages on your server.
*   **Priority support:** Get faster response times on the official support server.
*   **Shared perks:** MerelyBot premium perks also apply if you use that bot.

In addition, there is a higher tier of support on Yiays' Patreon which allows you to request custom features with a custom discord bot. [Talk with Yiays on Discord](https://discord.gg/wfKx24kDUR) before subscribing.

### Translation support

Anyone can contribute translations using the [Babel Translation Editor](https://translate.yiays.com) and submit any changes to the [official discord server](https://discord.gg/wfKx24kDUR). This also grants you ConfessionBot premium.

As of November 2024, ConfessionBot has at least partial support for the following languages (use `/language list` for an updated list);

*   English (default)
*   French
*   German
*   Polish
*   Vietnamese
*   Chinese (Simplified)
*   Tagalog
*   Portugues

Thank you to 3n3scan, charabe, 00xxe04, y4neko, stethoscope, kob, Windows, Jessa, and ChoccyMilk for your contributions!

### Settings

#### Channel Types

![](https://cdn.yiays.com/blog/cb-setup.webp)

There are 4 anonymous channel types. Set any channel to any of them using `/set`.

*   **💬 Anonymous:** Anyone that can see this channel can send anonymous messages here.
    *   This is the standard experience.
*   **📣 Feedback:** All member of the server can send messages here, even if they can't see the channel using `/confess-to`, or by confessing to an unset channel.
    *   Good for anonymous tips, requests, or something similar.
*   **🤔 Vetting:** These channels intercept anonymous messages headed to any other channel; a moderator must approve each message before they are sent.
    *   This effectively blocks all anonymous spam, harassment, and other attention-grabbing behaviour. _Highly recommended._
*   🛒 **Marketplace:** Messages require more information, like a price, payment methods, and a description before they are sent here. Offers can be sent and accepted anonymously.
    *   This is an experimental channel type which requires a custom bot to use. Anonymity is ended once a buyer and a seller agree on a price, their usernames are shared with each other.

In addition, Anon-IDs can be toggled on or off for most of these channel types using the Traceable toggle.

*   🟢**AnonIDs: Shown:** Each message will start with a (cryptographically secure) 6-character string and a colour. For example `Anon-fbd872`.
    *   Naturally, users might eventually notice patterns emerging from one Anon-ID, and they may start to make guesses as to who they are. Use `/shuffle` to change all Anon-IDs on your server in order to continue protecting the privacy of your users.
*   🔴**AnonIDs: Hidden:** No colour or string will appear next to messages, users will be indistinguishable from one another.
    *   Blocking Anon-IDs is more difficult when they are hidden, but they _are_ still recoverable. You will need to [join the support server](https://discord.gg/wfKx24kDUR) in order to get help with this.

#### Image support

![](https://cdn.yiays.com/blog/cb-imagesupport.webp)

Images are supported alongside text by default, this can be disabled using `/controlpanel` and clicking on 🟢 _Image Support: True_.

#### Moderation

![](https://cdn.yiays.com/blog/cb-moderation.webp)

Anyone with moderator permissions can block users from sending anonymous messages with `/block`, shuffle anon-ids with `/shuffle`, or approve and deny messages in vetting.

If you want to give other users these powers without making them a moderator, change the command permissions in your server settings.

### Privacy policy

_ConfessionBot promises users confidentiality like that you'd find with a doctor or therapist._ Only breaching user's privacy when there is good reason to be concerned about somebody's wellbeing. This strict confidentiality brings about a higher level of trust and safety for everyone using ConfessionBot. You can contact the developer (Yiays#5930 or [yiays@yiays.com](mailto:yiays@yiays.com)) at any time to request a full deletion of your data.

### Terms of Service

Before using ConfessionBot, you must read, understand, and agree to these terms. _Failure to do so could result in ConfessionBot being removed from your server, or your account being blocked from interacting with ConfessionBot._

*   **Respect the privacy of everyone else.** - Exposing private information about anybody without their consent is strictly forbidden. This includes exposing a user's anon-ID.
*   **Don't use ConfessionBot to conduct illegal activities.** - ConfessionBot will not serve users that wish to use anonymity for illegal activities.

If you witness other users breaking the ConfessionBot terms of service, report them to the developer (Yiays#5930 or [yiays@yiays.com](mailto:yiays@yiays.com)) right away.

### Testing

On the [Official Support Server](https://discord.gg/wfKx24kDUR), you can test out the bot, ask for help, or request new features and I'll do my best to get back to you quickly.

### Invite link

If you're interested, you can [add this bot to your server](https://top.gg/bot/562440687363293195)!

### Support the developer

You can support this bot by [rating it on the top.gg discord bot list](https://top.gg/bot/562440687363293195) or by subscribing to [ConfessionBot Premium](#premium-features).