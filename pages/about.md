---
layout: page
title: About
description: Some description.
permalink: /about/
instagram_username: crep_8
---

<img class="img-rounded" src="/assets/img/uploads/profile.png" alt="Martin Črepinšek" width="200">

# About me

I was born in Celje, Slovenia, into a Catholic family, where faith and strong values have always played an important role in my life. I completed my primary education in Celje and later moved to Ljubljana for high school, where I also began playing hockey for HK Olimpija. I spent two years with the club while attending Vegova – a specialized high school focused on computer science and engineering.

After high school, I continued my hockey journey internationally, playing in Austria, the United States, and Germany. Each country brought new challenges, cultures, and learning experiences, both on and off the ice.

Outside of hockey, I’m someone who enjoys solving problems and thinking strategically — which is why I love playing chess in my free time. As a kid, I was part of the Scouts, and that experience sparked my passion for nature, survival skills, and building things with my hands. I enjoy creating, fixing, and making practical tools or small projects — it keeps me grounded and connected to the world outside of the rink.

I’m also lucky to share my life with a wonderful partner. We've been together for two years now, and her support and positivity mean the world to me. She’s a big part of my life, and someone I’m truly grateful for.

Whether it’s on the ice, in the outdoors, or at home, I always try to bring dedication, creativity, and heart to everything I do.

# My clubs

<table>
  <thead>
    <tr>
      <th>Club</th>
      <th>Year</th>
      <th>Glavni trener</th>
      <th>Link</th>
    </tr>
  </thead>
  <tbody>
  {% for item in site.data.myclubs %}
    <tr>
      <td>{{item.Club}}</td>
      <td>{{item.Year}}</td>
      <td>{{item.Note}}</td>
      <td><a href="{{item.Link}}">WWW</a></td>
    </tr>
    {% endfor %}
  </tbody>
</table>
