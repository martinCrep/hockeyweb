---
layout: author
photo: /assets/img/uploads/profile.png
name: martincrepinsek
display_name: Martin Črepinšek (2005)
position: Player
bio: Hockey Player, ... , Scout, Computer science ...

instagram_username: crep_8
---

My clubs
<table>
  <thead>
    <tr>
      <th>Club</th>
      <th>Year</th>
    </tr>
  </thead>
  <tbody>
  {% for item in site.data.myclubs %}
    <tr>
      <td>{{item.Club}}</td>
      <td>{{item.Year}}</td>
    </tr>
    {% endfor %}
  </tbody>
</table>
