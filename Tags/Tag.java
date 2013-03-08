import java.io.*;
import java.util.HashMap;
import java.util.Set;
import java.util.Iterator;
import java.util.PriorityQueue;
import java.util.Comparator;


public class Tag {

  private static final int MAX_NEEDED = 50;

  public String tagName;
  public int frequency;

  public Tag(String name, int freq) {

    this.tagName = name;
    this.frequency = freq;

  }

  public static Comparator<Tag> TagComparator = new Comparator<Tag> () {

    public int compare (Tag t1, Tag t2) {

      if (t1.frequency == t2.frequency)
        return 0;

      //We need Max Heap..
      if(t1.frequency > t2.frequency)
        return -1;

      if(t1.frequency < t2.frequency)
        return 1;

      return 0;

    }

  };


  public static void  main(String args[]) {


    HashMap<String,Integer> mHashMap = new HashMap<String,Integer>();

    try {

      BufferedReader br = new BufferedReader (new FileReader("tags_input.txt"));
      String line;

      while((line = br.readLine()) != null) {

        String[] tokens = line.split(" ");

        for(String token : tokens) {

          Integer curr = mHashMap.get(token);

          if(curr == null){

            mHashMap.put(token,1);

          } else {

            mHashMap.put(token,curr+1);

          }

        }

      }

      br.close();

      PriorityQueue<Tag> tagHeap = new PriorityQueue<Tag>(100, Tag.TagComparator);

      Set<String> keys = mHashMap.keySet();
      Iterator<String> iter = keys.iterator();

      while(iter.hasNext()) {

        String key = iter.next();

        int freq = mHashMap.get(key);

        tagHeap.add(new Tag(key,freq));


      }

      BufferedWriter bw = new BufferedWriter(new FileWriter(new File("tags_output.txt"),true));
      int count = 0;
      Tag head = null;

      while ((head = tagHeap.peek()) != null) {

        String str = head.tagName+" "+head.frequency;

        tagHeap.remove(head);

        bw.write(str);
        bw.newLine();

        count++;

        if(count == MAX_NEEDED)
          break;

      }

      bw.close();


    } catch (IOException e) {

      e.printStackTrace();

    }


  }

}
