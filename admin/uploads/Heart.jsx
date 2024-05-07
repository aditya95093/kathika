import Image from 'next/image'
import React from 'react'
import Hearts from '../../public/home/heart2.png'

const Heart = () => {
  return (
    <div className='bg-white rounded-[40px] my-10'>
    <div className='container mx-auto'>
        <div className='flex flex-col lg:flex-row justify-between items-center gap-[40px] w-full py-6'>
<div className='lg:w-[60%] w-full'>
    <h3 className='md:text-[45px] text-[32px] font-Yeseva'>A Restoration from Heart</h3>
    <p className='md:text-[24px] text-[16px]  text-justify'>{`Two 19th Century Havelis facing each other, restored, are now turned into one-of-a-kind Museum. Founder and Curator, Mr. Atul Khanna, ‘A Pakka Dilliwala’ at heart aims to preserve, promote and celebrate the cultural heritage of Old Delhi.  The Kathika Cultural Centre brings to you a collection of Archival Photographs, Vintage Decorative Art Objects and Handicrafts, that takes you back in time.  Experience Kathika and commit to Zauq, the greatest poet of Old Delhi’s couplet - “Kaun Jaee ‘Zauq’ par Dilli ki galliyan chhodkar” `}</p>
</div>
<div className='lg:w-[40%] w-full'>
  <div className=''>
  <Image src={Hearts} alt='Hearts'  className=' w-[450px] h-[450px]  object-contain'/>
  </div>
</div>
        </div>
    </div>
      
    </div>
  )
}

export default Heart
