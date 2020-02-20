# Simple ZgPHP cover generator

This is a small and simple script for generating a cover image for upcoming ZgPHP meetups
As organizers, we have always had a slight problem with that since none of us are designers, dont have the necessary visual programs installed, etc.

After all, .svg files are basically XML, so why not make a little script to ake our cover for next months meetup!

Usage instructions

``git clone``

``composer install``

There are two ways to generate a new svg

Command line:
The script reads an input file, and outputs the new svg which you can output into an output file, like so:

``php index.php meetup.json > February.svg``


Via $_REQUEST
call the script with $_REQUEST parameters, with a GET for instance:
```
index.php?details[meetupNumber]=%23117&details[month]=03&details[day]=19&details[year]=1982&details[time]=18:44&venue[company]=Company d.o.o.&venue[address]=Rasmusa Lerdorfa 118&talks[0][speaker]=Hrvoje Hrvojić&talks[0][talkName]=Fun with Hrvoje&talks[1][speaker]=Luka Lukić&talks[1][talkName]=Luka is talking
```

You will need to install the font [Barlow](https://fonts.google.com/specimen/Barlow?selection.family=Barlow)

You only need Barlow-Black, Barlow-Regular, Barlow-Medium, Barlow-Bold and Barlow-Light installed

> Disclaimer: This is a simple script, used by ZgPHP organizers to make their life easier. It is not meant for production of any kind :) 

> It currently works only for 2 talks since all the positioning is done in place in pixels. You can always open the generated SVG in a text editor and hack away to make it work if you have an edge case (it's actually kind of simple)
>
>Comments and PRs are welcome :) 
