---
layout: page
title: About
description: Some description.
permalink: /about/
instagram_username: crep_8
---

<img class="img-rounded" src="/assets/img/uploads/profile.png" alt="Martin Črepinšek" width="200">

# About

My clubs
<table>
  <thead>
    <tr>
      <th>Club</th>
      <th>Year</th>
      <th>Note</th>
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
